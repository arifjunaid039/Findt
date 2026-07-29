<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CommunityController extends Controller
{
    /**
     * Display a paginated listing of communities.
     */
    public function index(Request $request)
    {
        $query = Community::approved()
            ->with(['members', 'items'])
            ->withCount(['members', 'items']);

        // Filter by location
        if ($request->filled('location')) {
            $query->where('location', $request->location);
        }

        $communities = $query->latest()
            ->paginate(15)
            ->withQueryString();

        // Get unique locations for dropdown (only from approved communities)
        $locations = Community::approved()
            ->whereNotNull('location')
            ->where('location', '!=', '')
            ->distinct()
            ->orderBy('location')
            ->pluck('location');

        return view('communities', compact('communities', 'locations'));
    }

    /**
     * Join a community.
     */
    public function join($id): RedirectResponse
    {
        $community = Community::findOrFail($id);
        $user = auth()->user();

        if ($community->members()->where('user_id', $user->id)->exists()) {
            return back()->with('info', 'You are already a member of this community.');
        }

        $community->members()->create(['user_id' => $user->id]);

        return back()->with('success', "You joined {$community->name}. You can now claim items reported in this community.");
    }

    /**
     * Leave a community.
     */
    public function leave($id): RedirectResponse
    {
        $community = Community::findOrFail($id);
        $community->members()->where('user_id', auth()->id())->delete();

        return back()->with('success', "You left {$community->name}.");
    }
}