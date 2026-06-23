<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:100',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits:11|unique:users,phone',
            'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/|unique:users,cnic',
            'address' => 'required|min:5',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
            'role' => 'required|in:member,leader',
        ]);

        $user = new User();

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cnic = $request->cnic;
        $user->address = $request->address;
        $user->role = $request->role;
        $user->community = $request->community;

        $user->password = Hash::make($request->password);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        Auth::login($user);

        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        Auth::login($user);

        return redirect('/')->with('success', 'Login successful!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required|max:255',
            'description' => 'required',
            'item_type' => 'required|in:lost,found',
            'location' => 'required|max:255',
            'item_date' => 'required|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/items'), $filename);
        }

        DB::table('items')->insert([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->item_name,
            'description' => $request->description,
            'item_type' => $request->item_type,
            'location' => $request->location,
            'date_occurred' => $request->item_date,
            'photo' => $filename,
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return redirect('/')->with('success', 'Item reported successfully!');
    }

    public function profile()
{
    return view('profile', [
        'user' => Auth::user()
    ]);
}

public function updateProfile(Request $request)
{
    $request->validate([
        'fullname' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $user = Auth::user();

    $user->fullname = $request->fullname;
    $user->phone = $request->phone;
    $user->address = $request->address;

    if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $user->photo = $filename;
    }

    $user->save();

return redirect('/profile')->with('success', 'Profile updated successfully!');}
}