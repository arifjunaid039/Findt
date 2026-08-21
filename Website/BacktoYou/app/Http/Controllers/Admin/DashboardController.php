<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Item;
use App\Models\Claim;
use App\Models\Conversation;
use App\Models\Community;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'      => User::count(),
            'active_users'     => User::where('status', 'active')->count(),
            'blocked_users'    => User::where('status', 'blocked')->count(),
            'total_items'      => Item::count(),
            'lost_items'       => Item::where('item_type', 'lost')->count(),
            'found_items'      => Item::where('item_type', 'found')->count(),
            'total_claims'     => Claim::count(),
            'pending_claims'   => Claim::where('status', 'pending')->count(),
            'approved_claims'  => Claim::where('status', 'approved')->count(),
            'total_reports' => Conversation::count(),
            'total_communities'=> Community::count(),
            'pending_communities' => Community::where('status', 'pending')->count(),
            'total_categories' => Category::count(),
        ];

        $recentItems  = Item::latest('created_at')->take(5)->get();
        $recentClaims = Claim::latest('created_at')->take(5)->get();
        $recentReports = Conversation::latest('created_at')->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentItems', 'recentClaims', 'recentReports'));
    }
}
