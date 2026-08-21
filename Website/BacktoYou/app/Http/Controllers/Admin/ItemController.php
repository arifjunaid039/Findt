<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class ItemController extends Controller
{
    /**
     * Display all items.
     */
    public function index(Request $request)
    {
        $request->validate([
            'search' => 'nullable|string|max:255',
            'type'   => 'nullable|in:lost,found',
            'status' => 'nullable|in:pending,approved,rejected,returned',
        ]);

        $query = Item::with(['user', 'category', 'claims']);        

        // Search    
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('color', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('contact_number', 'like', "%{$search}%")
                  ->orWhere('imei_number', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");

            });
        }

        // Item Type Filter
        if ($request->filled('type')) {
            $query->where('item_type', $request->type);
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $items = $query->orderBy('created_at', 'desc')
                       ->paginate(15)
                       ->withQueryString();

        return view('admin.items.index', compact('items'));
    }

    /**
     * Update Item Status
     */
    public function updateStatus(Request $request, Item $item)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,returned',
        ]);

        $item->status = $request->status;
        $item->save();

        return redirect()->back()->with('success', 'Item status updated successfully.');
    }

    /**
     * Delete Item
     */
    public function destroy(Item $item)
    {
        try {

            if ($item->photo && file_exists(public_path('uploads/items/' . $item->photo))) {
                unlink(public_path('uploads/items/' . $item->photo));
            }

            $item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully.');

        } catch (QueryException $e) {

            return redirect()->back()->with(
                'error',
                'Cannot delete this item because it has related records.'
            );
        }
    }
}