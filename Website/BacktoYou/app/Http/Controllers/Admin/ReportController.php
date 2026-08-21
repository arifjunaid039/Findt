<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConversationReport;
use App\Models\Conversation;
use App\Models\BlockedUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReportController extends Controller
{

public function index()
{
    $reports = ConversationReport::with([
        'claim.item',
        'reporter',
    ])
    ->latest('created_at')
    ->paginate(15);

    return view('admin.reports.index', compact('reports'));
}

    // Delete the reported item itself (action taken against the item)
    public function resolveDeleteItem(Report $report)
    {
        if ($report->item) {
            $report->item->delete();
        }
        $report->delete();

        return back()->with('success', 'Reported item removed and report resolved.');
    }

    // Dismiss the report without touching the item
public function destroy(ConversationReport $report)    {
        $report->delete();
        return back()->with('success', 'Report dismissed.');
    }

    public function block($conversationId)
{
    $conversation = Conversation::findOrFail($conversationId);

    // conversation ka doosra participant nikaalein (aapke schema ke hisaab se adjust karen)
    $otherUserId = $conversation->owner_id == Auth::id()
        ? $conversation->claimant_id
        : $conversation->owner_id;

    BlockedUser::firstOrCreate([
        'blocker_id' => Auth::id(),
        'blocked_id' => $otherUserId,
    ]);

    return response()->json(['success' => true]);
}

public function unblock($conversationId)
{
    $conversation = Conversation::findOrFail($conversationId);

    $otherUserId = $conversation->owner_id == Auth::id()
        ? $conversation->claimant_id
        : $conversation->owner_id;

    BlockedUser::where('blocker_id', Auth::id())
        ->where('blocked_id', $otherUserId)
        ->delete();

    return response()->json(['success' => true]);
}
}
