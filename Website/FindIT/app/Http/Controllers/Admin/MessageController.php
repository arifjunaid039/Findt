<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    // Change 'contacts' below if your table has a different name
    // (check app/Http/Controllers/ContactController.php to confirm).
    protected string $table = 'contacts';

    public function index(Request $request)
    {
        $query = DB::table($this->table);

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $sortable = ['fullname' => 'name', 'created_at' => 'created_at'];
        if ($sort = $request->get('sort')) {
            $column = $sortable[$sort] ?? 'created_at';
            $query->orderBy($column, $request->get('dir', 'asc'));
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $messages = $query->paginate(15)->withQueryString();

        return view('admin.messages', compact('messages'));
    }

    public function edit($id)
    {
        $message = DB::table($this->table)->where('id', $id)->firstOrFail();

        return view('admin.messages-edit', compact('message'));
    }

    public function destroy($id)
    {
        DB::table($this->table)->where('id', $id)->delete();

        return back()->with('success', 'Message deleted.');
    }
}