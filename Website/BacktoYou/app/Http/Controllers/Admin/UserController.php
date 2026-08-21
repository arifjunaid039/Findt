<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('fullname', 'like', "%{$s}%")
                  ->orWhere('email', 'like', "%{$s}%")
                  ->orWhere('phone', 'like', "%{$s}%")
                  ->orWhere('cnic', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function block(User $user)
    {
        $user->update(['status' => 'blocked']);
        return back()->with('success', "{$user->fullname} has been blocked.");
    }

    public function unblock(User $user)
    {
        $user->update(['status' => 'active']);
        return back()->with('success', "{$user->fullname} has been unblocked.");
    }

    public function makeAdmin(User $user)
    {
        $user->update(['role' => 'admin']);
        return back()->with('success', "{$user->fullname} is now an admin.");
    }

    public function removeAdmin(User $user)
    {
        $user->update(['role' => 'user']);
        return back()->with('success', "{$user->fullname} is no longer an admin.");
    }

    public function destroy(User $user)
    {
        // Cascades to items via fk_items_user ON DELETE CASCADE
        $user->delete();
        return back()->with('success', 'User deleted.');
    }
}
