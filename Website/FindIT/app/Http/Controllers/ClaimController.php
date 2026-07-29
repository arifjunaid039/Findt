<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Item;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = Claim::with(['item', 'claimant']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $claims = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.claims.index', compact('claims'));
    }

    public function create($id)
{
    $item = Item::findOrFail($id);

    return view('claims.create', compact('item'));
}

public function approve($id)
{
    $claim = Claim::findOrFail($id);

    $claim->update([
        'status' => 'approved'
    ]);

    Claim::where('item_id', $claim->item_id)
        ->where('id', '!=', $claim->id)
        ->update([
            'status' => 'rejected'
        ]);

    $item = Item::findOrFail($claim->item_id);

    $updated = $item->update([
        'status' => 'approved'
    ]);

    dd([
        'claim_item_id' => $claim->item_id,
        'item_before_refresh' => $item,
        'updated' => $updated,
        'item_after_refresh' => $item->fresh(),
    ]);
}
public function reject($id)
{
    $claim = Claim::findOrFail($id);

    $claim->update([
        'status' => 'rejected'
    ]);

    return back()->with('success', 'Claim rejected successfully.');
}

    public function destroy(Claim $claim)
    {
        $claim->delete();
        return back()->with('success', 'Claim deleted.');
    }

    public function requests()
{
    $claims = \App\Models\Claim::with(['item', 'claimant'])
        ->latest()
        ->paginate(15);

    return view('claims.requests', compact('claims'));
}

}
