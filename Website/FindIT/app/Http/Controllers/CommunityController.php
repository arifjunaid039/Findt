<?php

namespace App\Http\Controllers;

use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    // Show all communities
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $communities = Community::all();
        return view('communities', compact('communities'));
    }

    // Join a community
    public function join($id)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        $user->communities()->syncWithoutDetaching([$id]);

        return back()->with('success', 'Joined successfully!');
    }
}