<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Start Claim
    |--------------------------------------------------------------------------
    */

    public function startClaim(Request $request, $item)
    {
        $request->validate([
            'message' => 'required|min:10'
        ]);

        $itemData = DB::table('items')
            ->where('id', $item)
            ->first();

        if (!$itemData) {
            abort(404);
        }

        // Prevent duplicate claim

        $claim = DB::table('claims')
            ->where('item_id', $item)
            ->where('claimant_id', Auth::id())
            ->first();

        if (!$claim) {

            $claimId = DB::table('claims')->insertGetId([
                'item_id'      => $itemData->id,
                'claimant_id'  => Auth::id(),
                'message'      => $request->message,
                'status'       => 'pending',
                'created_at'   => now(),
                'updated_at'   => now()
            ]);

        } else {

            $claimId = $claim->id;

        }

        // First chat message

        DB::table('claim_messages')->insert([
            'claim_id'   => $claimId,
            'sender_id'  => Auth::id(),
            'message'    => $request->message,
            'is_read'    => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('messages.show', $claimId);
    }

    /*
    |--------------------------------------------------------------------------
    | Messages Page
    |--------------------------------------------------------------------------
    */

    public function index($claim = null)
    {
        $conversations = $this->getConversationList();

        $conversation = null;
        $messages = collect();

        if ($claim) {

            $conversation = $this->getConversation($claim);

            if (!$conversation) {
                abort(404);
            }

            DB::table('claim_messages')
                ->where('claim_id', $claim)
                ->where('sender_id', '!=', Auth::id())
                ->update([
                    'is_read' => 1
                ]);

            $messages = DB::table('claim_messages')
                ->join('users', 'claim_messages.sender_id', '=', 'users.id')
                ->where('claim_id', $claim)
                ->select(
                    'claim_messages.*',
                    'users.fullname'
                )
                ->orderBy('claim_messages.created_at')
                ->get();
        }

        return view('messages.index', compact(
            'conversations',
            'conversation',
            'messages'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Show Conversation
    |--------------------------------------------------------------------------
    */

    public function show($claim)
    {
        return $this->index($claim);
    }

    /*
    |--------------------------------------------------------------------------
    | Send Message
    |--------------------------------------------------------------------------
    */

    public function send(Request $request, $claim)
    {
        $this->authorizeConversation($claim);
        $this->checkNotBlocked($claim);

        $request->validate([
            'message' => 'required'
        ]);

        $count = DB::table('claim_messages')
            ->where('claim_id', $claim)
            ->count();

        if ($count == 0) {

            DB::table('claims')
                ->where('id', $claim)
                ->update([
                    'message' => $request->message
                ]);

        }

        DB::table('claim_messages')->insert([
            'claim_id'   => $claim,
            'sender_id'  => Auth::id(),
            'message'    => $request->message,
            'is_read'    => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back();
    }

    /*
    |--------------------------------------------------------------------------
    | Send Message (AJAX)
    |--------------------------------------------------------------------------
    */

    public function sendAjax(Request $request, $claim)
    {
        $this->authorizeConversation($claim);
        $this->checkNotBlocked($claim);

        $request->validate([
            'message' => 'required'
        ]);

        DB::table('claim_messages')->insert([
            'claim_id'   => $claim,
            'sender_id'  => Auth::id(),
            'message'    => $request->message,
            'is_read'    => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json([
            'success' => true
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Load Messages (AJAX Polling)
    |--------------------------------------------------------------------------
    */

    public function loadMessages($claim)
    {
        $this->authorizeConversation($claim);

        DB::table('claim_messages')
            ->where('claim_id', $claim)
            ->where('sender_id', '!=', Auth::id())
            ->update([
                'is_read' => 1
            ]);

        $messages = DB::table('claim_messages')
            ->join('users', 'claim_messages.sender_id', '=', 'users.id')
            ->where('claim_id', $claim)
            ->select(
                'claim_messages.*',
                'users.fullname'
            )
            ->orderBy('claim_messages.created_at')
            ->get();

        return response()->json($messages);
    }

    /*
    |--------------------------------------------------------------------------
    | Block / Unblock / Report
    |--------------------------------------------------------------------------
    */

    public function block($claim)
    {
        $this->authorizeConversation($claim);

        DB::table('claims')
            ->where('id', $claim)
            ->update([
                'is_blocked' => 1,
                'blocked_by' => Auth::id(),
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function unblock($claim)
    {
        $this->authorizeConversation($claim);

        $row = DB::table('claims')->where('id', $claim)->first();

        if (!$row || $row->blocked_by != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot unblock this conversation.'
            ], 403);
        }

        DB::table('claims')
            ->where('id', $claim)
            ->update([
                'is_blocked' => 0,
                'blocked_by' => null,
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function report(Request $request, $claim)
    {
        $this->authorizeConversation($claim);

        $request->validate([
            'reason'  => 'required|in:spam,inappropriate,harassment,fake_item,other',
            'details' => 'nullable|string|max:1000',
        ]);

        DB::table('conversation_reports')->insert([
            'claim_id'    => $claim,
            'reporter_id' => Auth::id(),
            'reason'      => $request->reason,
            'details'     => $request->details,
            'status'      => 'open',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return response()->json(['success' => true]);
    }

    /*
    |--------------------------------------------------------------------------
    | Conversation List
    |--------------------------------------------------------------------------
    */

    private function getConversationList()
    {
        return DB::table('claims')
            ->join('items', 'claims.item_id', '=', 'items.id')

            ->join('users', function ($join) {
                $join->on(
                    'users.id',
                    '=',
                    DB::raw(
                        'CASE
                            WHEN claims.claimant_id = ' . Auth::id() . '
                            THEN items.user_id
                            ELSE claims.claimant_id
                        END'
                    )
                );
            })

            ->where(function ($q) {
                $q->where('claims.claimant_id', Auth::id())
                  ->orWhere('items.user_id', Auth::id());
            })

            ->select(
                'claims.id',
                'claims.status',
                'items.title',
                'items.photo',
                'items.item_type',
                'users.fullname'
            )

            ->addSelect([
                'last_message' => DB::table('claim_messages')
                    ->select('message')
                    ->whereColumn('claim_messages.claim_id', 'claims.id')
                    ->latest('created_at')
                    ->limit(1)
            ])

            ->addSelect([
                'updated_at' => DB::table('claim_messages')
                    ->select('created_at')
                    ->whereColumn('claim_messages.claim_id', 'claims.id')
                    ->latest('created_at')
                    ->limit(1)
            ])

            ->addSelect([
                'unread' => DB::table('claim_messages')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('claim_messages.claim_id', 'claims.id')
                    ->where('sender_id', '!=', Auth::id())
                    ->where('is_read', 0)
            ])

            ->orderByDesc('updated_at')
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Get Single Conversation
    |--------------------------------------------------------------------------
    */

    private function getConversation($claim)
    {
        $conversation = DB::table('claims')
            ->join('items', 'claims.item_id', '=', 'items.id')
            ->where('claims.id', $claim)

            ->where(function ($q) {
                $q->where('claims.claimant_id', Auth::id())
                  ->orWhere('items.user_id', Auth::id());
            })

            ->select(
                'claims.*',
                'items.title',
                'items.photo',
                'items.item_type',
                'items.user_id as owner_id' // needed so the view can restrict Approve/Reject to the item owner only
            )

            ->first();

        if ($conversation) {
            $conversation->blocked_by_me = (bool) $conversation->is_blocked
                && $conversation->blocked_by == Auth::id();
        }

        return $conversation;
    }

    /*
    |--------------------------------------------------------------------------
    | Authorize Conversation
    |--------------------------------------------------------------------------
    */

    private function authorizeConversation($claim)
    {
        $exists = DB::table('claims')
            ->join('items', 'claims.item_id', '=', 'items.id')

            ->where('claims.id', $claim)

            ->where(function ($q) {
                $q->where('claims.claimant_id', Auth::id())
                  ->orWhere('items.user_id', Auth::id());
            })

            ->exists();

        if (!$exists) {
            abort(403);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Check Not Blocked (prevents sending new messages in a blocked chat)
    |--------------------------------------------------------------------------
    */

    private function checkNotBlocked($claim)
    {
        $blocked = DB::table('claims')
            ->where('id', $claim)
            ->value('is_blocked');

        if ($blocked) {
            abort(403, 'This conversation is blocked.');
        }
    }

    public function startChat($id)
    {
        $claim = DB::table('claims')
            ->where('item_id', $id)
            ->where('claimant_id', Auth::id())
            ->first();

        if (!$claim) {

            $claimId = DB::table('claims')->insertGetId([
                'item_id'     => $id,
                'claimant_id' => Auth::id(),
                'status'      => 'pending',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);

        } else {

            $claimId = $claim->id;
        }

        return redirect()->route('messages.show', $claimId);
    }
}