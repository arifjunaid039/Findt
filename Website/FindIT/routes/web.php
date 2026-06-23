<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;


/* =========================
   PUBLIC ROUTES
========================= */

Route::get('/', function () {

    $items = DB::table('items')
        ->orderBy('id', 'desc')
        ->limit(4)
        ->get();

    return view('Home', compact('items'));
});

Route::get('/About', function () {
    return view('About');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/profile', [AuthController::class, 'profile']);
Route::post('/profile/update', [AuthController::class, 'updateProfile']);

Route::post('/profile/delete', function () {

    $user = Auth::user();

    // delete user
DB::table('items')->where('user_id', $user->id)->delete();
DB::table('users')->where('id', $user->id)->delete();
    Auth::logout();

    return redirect('/register')->with('success', 'Account deleted successfully.');
});
/* =========================
   PROTECTED ROUTES (LOGIN REQUIRED)
========================= */

Route::middleware('auth')->group(function () {

    Route::get('/Report', function () {
        return view('Report');
    });

    Route::post('/items/store', [AuthController::class, 'store']);

    Route::get('/Lostitems', function () {
        $items = DB::select("SELECT * FROM items WHERE item_type = 'lost' ORDER BY id DESC");
        return view('Lostitems', compact('items'));
    });

    Route::get('/Founditems', function () {
        $items = DB::select("SELECT * FROM items WHERE item_type = 'found' ORDER BY id DESC");
        return view('Founditems', compact('items'));
    });

    Route::middleware('auth')->group(function () {
    Route::get('/communities', [CommunityController::class, 'index']);
    Route::post('/communities/join/{id}', [CommunityController::class, 'join']);
});

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/login');
    });
});