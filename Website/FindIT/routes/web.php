<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClaimController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Admin\ClaimController as AdminClaimController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Admin\CommunityController as AdminCommunityController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\VerificationController as AdminVerificationController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AdminAuthController;

/*
|--------------------------------------------------------------------------
| HELPER: exclude items that already have an approved claim
|--------------------------------------------------------------------------
| Used by Lostitems, Founditems, and the combined Items page so the
| "hide already-claimed items" rule stays in one place instead of being
| copy-pasted three times.
*/
function excludeApprovedClaims($query)
{
    return $query->whereNotExists(function ($q) {
        $q->select(DB::raw(1))
            ->from('claims')
            ->whereColumn('claims.item_id', 'items.id')
            ->where('claims.status', 'approved');
    });
}

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::patch('/{user}/block', [AdminUserController::class, 'block'])->name('block');
        Route::patch('/{user}/unblock', [AdminUserController::class, 'unblock'])->name('unblock');
        Route::patch('/{user}/make-admin', [AdminUserController::class, 'makeAdmin'])->name('makeAdmin');
        Route::patch('/{user}/remove-admin', [AdminUserController::class, 'removeAdmin'])->name('removeAdmin');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
    });

    // Items
    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/', [AdminItemController::class, 'index'])->name('index');
        Route::patch('/{item}/status', [AdminItemController::class, 'updateStatus'])->name('status');
        Route::delete('/{item}', [AdminItemController::class, 'destroy'])->name('destroy');
    });

    // Claims
    Route::prefix('claims')->name('claims.')->group(function () {
        Route::get('/', [AdminClaimController::class, 'index'])->name('index');
        Route::patch('/{claim}/approve', [AdminClaimController::class, 'approve'])->name('approve');
        Route::patch('/{claim}/reject', [AdminClaimController::class, 'reject'])->name('reject');
        Route::delete('/{claim}', [AdminClaimController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [AdminReportController::class, 'index'])->name('index');
        Route::delete('/{report}/delete-item', [AdminReportController::class, 'resolveDeleteItem'])->name('deleteItem');
        Route::delete('/{report}', [AdminReportController::class, 'destroy'])->name('destroy');
    });

    // Communities
    Route::prefix('communities')->name('communities.')->group(function () {
        Route::get('/', [AdminCommunityController::class, 'index'])->name('index');
        Route::patch('/{community}/approve', [AdminCommunityController::class, 'approve'])->name('approve');
        Route::patch('/{community}/reject', [AdminCommunityController::class, 'reject'])->name('reject');
        Route::delete('/{community}', [AdminCommunityController::class, 'destroy'])->name('destroy');
    });

    // Categories
    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [AdminCategoryController::class, 'index'])->name('index');
        Route::post('/', [AdminCategoryController::class, 'store'])->name('store');
        Route::patch('/{category}', [AdminCategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [AdminCategoryController::class, 'destroy'])->name('destroy');
    });

    // Verification Requests
    Route::prefix('verifications')->name('verifications.')->group(function () {
        Route::get('/', [AdminVerificationController::class, 'index'])->name('index');
        Route::patch('/{id}/approve', [AdminVerificationController::class, 'approve'])->name('approve');
        Route::patch('/{id}/reject', [AdminVerificationController::class, 'reject'])->name('reject');
    });

    // Messages (contact form submissions)
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [AdminMessageController::class, 'index'])->name('index');
        Route::get('/{message}/edit', [AdminMessageController::class, 'edit'])->name('edit');
        Route::delete('/{message}', [AdminMessageController::class, 'destroy'])->name('destroy');
    });
});

// Admin auth lives outside the auth+admin group, since the admin isn't logged in yet
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $lostQuery = DB::table('items')->where('item_type', 'lost');
    $lostQuery = excludeApprovedClaims($lostQuery);
    $lostItems = $lostQuery->orderBy('id', 'desc')->limit(3)->get();

    $foundQuery = DB::table('items')->where('item_type', 'found');
    $foundQuery = excludeApprovedClaims($foundQuery);
    $foundItems = $foundQuery->orderBy('id', 'desc')->limit(3)->get();

    $categories = DB::table('categories')->orderBy('name')->get();

    return view('Home', compact('lostItems', 'foundItems', 'categories'));
})->name('home');

Route::get('/About', function () {
    return view('About');
})->name('about');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/faq', function () {
        return view('faq');
    });


/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [AuthController::class, 'register']);


Route::post('/send-otp', [OtpController::class, 'sendOtp'])
    ->middleware('throttle:5,1')
    ->name('otp.send');

Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])
    ->middleware('throttle:10,1')
    ->name('otp.verify');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\NoCacheHeaders::class])->group(function () {

    /*
    |----------------------------------------------------------------------
    | CLAIM SYSTEM
    |----------------------------------------------------------------------
    */
    Route::prefix('claim')->name('claim.')->group(function () {
        Route::get('/requests', [ClaimController::class, 'requests'])->name('requests');
        Route::get('/{id}', [ClaimController::class, 'create'])->name('create');
        Route::post('/{id}', [ClaimController::class, 'store'])->name('store');
        Route::post('/{id}/approve', [ClaimController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [ClaimController::class, 'reject'])->name('reject');
    });

    /*
    |----------------------------------------------------------------------
    | MESSAGES / CHAT
    |----------------------------------------------------------------------
    */
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/start/{id}', [ChatController::class, 'startChat'])->name('start');
        Route::get('/', [ChatController::class, 'index'])->name('index');
        Route::get('/{claim}', [ChatController::class, 'show'])->name('show');
        Route::post('/{claim}/send', [ChatController::class, 'send'])->name('send');
        Route::post('/{claim}/send-ajax', [ChatController::class, 'sendAjax'])->name('send.ajax');
        Route::get('/{claim}/load', [ChatController::class, 'loadMessages'])->name('load');
        Route::post('/{claim}/block', [ChatController::class, 'block'])->name('block');
        Route::post('/{claim}/unblock', [ChatController::class, 'unblock'])->name('unblock');
        Route::post('/{claim}/report', [ChatController::class, 'report'])->name('report');
    });

    /*
    |----------------------------------------------------------------------
    | PROFILE
    |----------------------------------------------------------------------
    */
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::post('/profile/delete', function () {
        $user = Auth::user();

        DB::table('items')->where('user_id', $user->id)->delete();
        DB::table('users')->where('id', $user->id)->delete();

        Auth::logout();

        return redirect('/register')->with('success', 'Account deleted successfully');
    })->name('profile.delete');

    /*
    |----------------------------------------------------------------------
    | CONTACT
    |----------------------------------------------------------------------
    */
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact.form');

    Route::post('/contact', [ContactController::class, 'store'])->name('contact');

    /*
    |----------------------------------------------------------------------
    | ITEMS
    |----------------------------------------------------------------------
    */
    Route::get('/Report', function () {
        $categories = DB::table('categories')->orderBy('name')->get();

        // Communities the logged-in user has joined — for the "post to community" dropdown
        $myCommunities = Auth::user()->communities ?? collect();

        return view('Report', compact('categories', 'myCommunities'));
    })->name('report.form');

    Route::post('/items/store', [AuthController::class, 'store'])->name('items.store');

    Route::get('/Lostitems', function () {
        $query = DB::table('items')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
            ->where('item_type', 'lost')
            ->select('items.*', 'categories.name as category_name');

        $query = excludeApprovedClaims($query);

        $items = $query->orderBy('items.id', 'desc')->get();

        $categories = DB::table('categories')->orderBy('name')->get();

        return view('Lostitems', compact('items', 'categories'));
    })->name('items.lost');

    Route::get('/Founditems', function () {
        $query = DB::table('items')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
            ->where('items.item_type', 'found')
            ->select('items.*', 'categories.name as category_name');

        $query = excludeApprovedClaims($query);

        $items = $query->orderBy('items.id', 'desc')->get();

        $categories = DB::table('categories')->orderBy('name')->get();

        return view('Founditems', compact('items', 'categories'));
    })->name('items.found');

    Route::get('/Items', function () {
        $type = request('type');
        $categoryId = request('category');
        $communityId = request('community');

        $query = DB::table('items')
            ->leftJoin('categories', 'items.category_id', '=', 'categories.id')
            ->select('items.*', 'categories.name as category_name');

        $query = excludeApprovedClaims($query);

        if ($type) {
            $query->where('item_type', $type);
        }

        if ($categoryId) {
            $query->where('items.category_id', $categoryId);
        }

        $selectedCommunity = null;

        if ($communityId) {
            $selectedCommunity = DB::table('communities')->where('id', $communityId)->first();

            if ($selectedCommunity && $selectedCommunity->location) {
                // Match items whose location contains the community's location
                $query->where('items.location', 'LIKE', '%' . $selectedCommunity->location . '%');
            }
        } elseif (Auth::check()) {
            // No specific community selected — prioritize items matching any joined community's location
            $myLocations = Auth::user()->communities()->pluck('communities.location')->filter()->toArray();

            if (count($myLocations)) {
                $cases = collect($myLocations)->map(function ($loc) {
                    return "items.location LIKE " . DB::getPdo()->quote('%' . $loc . '%');
                })->implode(' OR ');

                $query->orderByRaw("($cases) DESC");
            }
        }

        $items = $query->orderBy('items.id', 'desc')->get();

        $categories = DB::table('categories')->orderBy('name')->get();

        return view('Items', compact('items', 'categories', 'type', 'selectedCommunity'));
    })->name('items.all');

    /*
    |----------------------------------------------------------------------
    | LOGOUT
    |----------------------------------------------------------------------
    */
    Route::post('/logout', function (\Illuminate\Http\Request $request) {
        Auth::logout();

        // Fully wipe session data, not just invalidate the ID
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $response = redirect('/login');

        // Also clear the "remember me" cookie so re-visiting the site
        // doesn't silently log the user back in
        return $response->withCookie(\Illuminate\Support\Facades\Cookie::forget(
            \Illuminate\Support\Facades\Auth::getRecallerName()
        ));
    })->name('logout');
});


/*
|--------------------------------------------------------------------------
| COMMUNITY AUTH
|--------------------------------------------------------------------------
*/

Route::get('/communityregister', function () {
    return view('communityregister');
})->name('community.register');

Route::post('/communityregister', [AuthController::class, 'registerCommunity']);

Route::get('/communitylogin', function () {
    return view('communitylogin');
})->name('community.login');

Route::post('/communitylogin', [AuthController::class, 'communityLogin']);

Route::post('/communitylogout', [AuthController::class, 'communityLogout'])->name('community.logout');


/*
|--------------------------------------------------------------------------
| COMMUNITIES
|--------------------------------------------------------------------------
*/

Route::get('/communities', [CommunityController::class, 'index'])->name('communities');

Route::middleware(['auth', \App\Http\Middleware\NoCacheHeaders::class])->group(function () {
    Route::post('/communities/join/{id}', [CommunityController::class, 'join'])->name('communities.join');
    Route::post('/communities/leave/{id}', [CommunityController::class, 'leave'])->name('communities.leave');
    Route::get('/my-communities', [CommunityController::class, 'myCommunities'])->name('communities.mine');
});


/*
|--------------------------------------------------------------------------
| COMMUNITY PROFILE
|--------------------------------------------------------------------------
*/

Route::middleware(\App\Http\Middleware\NoCacheHeaders::class)->group(function () {
    Route::get('/community/profile', [AuthController::class, 'communityProfile'])->name('community.profile');
    Route::post('/community/profile/update', [AuthController::class, 'updateCommunityProfile'])->name('community.profile.update');
    Route::post('/community/profile/delete', [AuthController::class, 'deleteCommunityProfile'])->name('community.profile.delete');
});

Route::get('/register-success', function () {
    return view('success');
})->name('register.success');