<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OtpService
{
    public function generateAndSend(int $userId, string $phone): string
    {
        $otp = (string) random_int(100000, 999999);

        DB::table('users')->where('id', $userId)->update([
            'phone_otp' => $otp,
            'phone_otp_expires_at' => now()->addMinutes(10),
        ]);

        $message = "Your BackToYou verification code is: {$otp}. Valid for 10 minutes.";

        $this->sendSms($phone, $message);

        return $otp;
    }

    protected function sendSms(string $phone, string $message): void
    {
        $apiKey = env('VEEVO_API_KEY');
        $url = env('VEEVO_SMS_URL');

        $formattedPhone = $this->formatPhoneNumber($phone);

        if (!$apiKey || !$url) {
            Log::error('Veevo API credentials are missing.');
            return;
        }

        try {
            $response = Http::timeout(15)->post($url, [
                'apikey' => $apiKey,
                'receivernum' => $formattedPhone,
                'textmessage' => $message,
            ]);

            $data = $response->json();

            if (!$response->successful() || ($data['STATUS'] ?? '') !== 'SUCCESSFUL') {
                Log::error('Veevo SMS failed', [
                    'phone' => $formattedPhone,
                    'response' => $data,
                ]);

                return;
            }

            Log::info('Veevo SMS sent successfully', [
                'phone' => $formattedPhone,
                'message_id' => $data['MESSAGE_ID'] ?? null,
                'charged_balance' => $data['CHARGED_BALANCE'] ?? null,
            ]);

        } catch (\Exception $e) {
            Log::error('Veevo SMS exception', [
                'phone' => $formattedPhone,
                'error' => $e->getMessage(),
            ]);
        }
    }

    protected function formatPhoneNumber(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);

        if (str_starts_with($phone, '0')) {
            return '+92' . substr($phone, 1);
        }

        if (str_starts_with($phone, '92')) {
            return '+' . $phone;
        }

        return $phone;
    }

    public function verify(int $userId, string $inputOtp): bool
    {
        $user = DB::table('users')->where('id', $userId)->first();

        if (!$user || !$user->phone_otp || !$user->phone_otp_expires_at) {
            return false;
        }

        if (now()->greaterThan($user->phone_otp_expires_at)) {
            return false;
        }

        if ($user->phone_otp !== $inputOtp) {
            return false;
        }

        DB::table('users')->where('id', $userId)->update([
            'phone_verified_at' => now(),
            'phone_otp' => null,
            'phone_otp_expires_at' => null,
        ]);

        return true;
    }
}