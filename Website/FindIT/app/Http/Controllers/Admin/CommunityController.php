<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Community;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $query = Community::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $communities = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.communities.index', compact('communities'));
    }

    public function approve(Community $community)
    {
        $community->update(['status' => 'approved']);
        return back()->with('success', "'{$community->name}' approved.");
    }

    public function reject(Community $community)
    {
        $community->update(['status' => 'rejected']);
        return back()->with('success', "'{$community->name}' rejected.");
    }

    public function destroy(Community $community)
    {
        $community->delete();
        return back()->with('success', 'Community deleted.');
    }
}
