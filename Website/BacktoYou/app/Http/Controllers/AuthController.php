<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Community;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class AuthController extends Controller
{
/*
    |--------------------------------------------------------------------------
    | USER REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate([
    'fullname' => 'required|min:3|max:100',
    'email' => 'required|email|unique:users,email',
    'phone' => 'required|digits:11|unique:users,phone',
    'cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/|unique:users,cnic',
    'address' => 'required|min:5',
    'photo' => 'required|image|mimes:jpg,jpeg,png,avif,webp|max:2048',
    'password' => 'required|min:8|same:confirm_password',
    'confirm_password' => 'required',
]);

        $user = new User();

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->cnic = $request->cnic;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->verification_status = 'pending'; // will be overwritten below once Face++ responds

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }

        if ($request->hasFile('cnic_photo')) {
            $file = $request->file('cnic_photo');
            $cnicFilename = time() . '_cnic.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/cnic'), $cnicFilename);
            $user->cnic_photo = $cnicFilename;
        }

        $user->save();

        Auth::login($user);

        app(\App\Services\OtpService::class)->generateAndSend($user->id, $user->phone);

        return redirect()->route('verify-phone.show');
    }

    /*
    |--------------------------------------------------------------------------
    | USER LOGIN
    |--------------------------------------------------------------------------
    */

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(array_merge($credentials, ['status' => 'active']), $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    $user = \App\Models\User::where('email', $credentials['email'])->first();
    if ($user && $user->status === 'blocked') {
        return back()->withErrors([
            'email' => 'Your account has been blocked. Contact support if you think this is a mistake.',
        ])->onlyInput('email');
    }

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ])->onlyInput('email');
}

    /*
    |--------------------------------------------------------------------------
    | REPORT LOST / FOUND ITEM
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'item_type' => 'required|in:lost,found',
            'item_date' => 'required|date',
            'location' => 'required|max:255',
            'description' => 'required',
            'contact_number' => 'required|max:20',
            'photo' => 'required|file|mimes:jpg,jpeg,png,avif,webp|max:2048',
            'category_id' => 'nullable|max:255',
            'brand' => 'nullable|max:100',
            'color' => 'nullable|max:50',
            'sub_type' => 'nullable|max:100',
            'sub_type_other' => 'nullable|max:100',
            'imei_number' => 'nullable|max:50',
            'serial_number' => 'nullable|max:100',
            'verification_notes' => 'nullable',
            'community_id' => 'nullable|exists:communities,id',
        ]);

        $filename = null;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/items'), $filename);
        }
        $category = DB::table('categories')
            ->where('id', $request->category_id)
            ->first();

        if (!$category) {
            return back()->withErrors([
                'category_id' => 'Please select a valid category.'
            ]);
        }

        $title = $category->name;
        DB::table('items')->insert([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'community_id' => $request->community_id ?: null,
            'title' => $title,
            'brand' => $request->brand,
            'color' => $request->color,
            'description' => $request->description,
            'item_type' => $request->item_type,
            'location' => $request->location,
            'date_occurred' => $request->item_date,
            'contact_number' => $request->contact_number,
            'sub_type' => $request->sub_type ?: $request->sub_type_other,
            'imei_number' => $request->imei_number,
            'serial_number' => $request->serial_number,
            'verification_notes' => $request->verification_notes,
            'photo' => $filename,
            'created_at' => now(),
        ]);

        return redirect('/')
            ->with('success', 'Item reported successfully!');
    }

    public function profile()
    {
        $user = auth()->user();

        $myCommunities = $user->communities ?? collect(); // adjust relation name if different

        return view('profile', compact('user', 'myCommunities'));
    }

    public function registerCommunity(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:communities,email',
            'category' => 'required|max:100',
            'description' => 'required',
            'rules' => 'required',
            'leader_phone' => 'required|digits:11',
            'location' => 'required|max:255',
            'leader_cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/',
            'password' => 'required|min:8|confirmed',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $community = new Community();

        $community->name = $request->name;
        $community->email = $request->email;
        $community->password = Hash::make($request->password);
        $community->category = $request->category;
        $community->description = $request->description;
        $community->rules = $request->rules;
        $community->leader_phone = $request->leader_phone;
        $community->location = $request->location;
        $community->leader_cnic = $request->leader_cnic;
        $community->leader_id = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/communities'), $filename);
            $community->image = $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = time().'_banner_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/communities'), $bannerName);
            $community->banner = $bannerName;
        }

        $community->save();

        return redirect('/communities')
            ->with('success', 'Community created successfully!');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'fullname' => 'required|max:255',
            'phone' => 'required|digits:11',
            'address' => 'required|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        $user->fullname = $request->fullname;
        $user->phone = $request->phone;
        $user->address = $request->address;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect('/profile')
            ->with('success', 'Profile updated successfully!');
    }

    public function communityLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $community = Community::where('email', $request->email)->first();

        if (!$community) {
            return back()->withErrors([
                'email' => 'Community email not found.'
            ]);
        }

        if (!Hash::check($request->password, $community->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.'
            ]);
        }

        session([
            'community_id' => $community->id
        ]);

        return redirect('/communities')
            ->with('success', 'Community login successful!');
    }

    public function communityLogout(Request $request)
    {
        // Remove all community session data
        $request->session()->forget([
            'community_id',
            'community_name',
            'community_email'
        ]);

        // Destroy the session completely
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/communitylogin')
            ->with('success', 'Community logged out successfully.');
    }


    public function communityProfile()
    {
        $community = null;

        if (session()->has('community_id')) {
            $community = Community::find(session('community_id'));
        }

        if (!$community && Auth::check()) {
            $community = Community::where('leader_id', Auth::id())->first();
        }

        if (!$community) {
            return redirect('/communitylogin')
                ->with('error', 'Please log in to manage your community.');
        }

        return view('community-profile', compact('community'));
    }

    public function deleteCommunityProfile(Request $request)
    {
        $community = null;

        if (session()->has('community_id')) {
            $community = Community::find(session('community_id'));
        } elseif (Auth::check()) {
            $community = Community::where('leader_id', Auth::id())->first();
        }

        if (!$community) {
            return redirect('/communitylogin')
                ->with('error', 'Please log in first.');
        }

        $community->delete();

        $request->session()->forget(['community_id', 'community_name', 'community_email']);
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/communities')
            ->with('success', 'Community deleted successfully.');
    }

    public function updateCommunityProfile(Request $request)
    {
        $community = null;

        if (session()->has('community_id')) {
            $community = Community::find(session('community_id'));
        } elseif (Auth::check()) {
            $community = Community::where('leader_id', Auth::id())->first();
        }

        if (!$community) {
            return redirect('/communitylogin')
                ->with('error', 'Please log in first.');
        }

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:communities,email,' . $community->id,
            'category' => 'required|max:100',
            'description' => 'required',
            'rules' => 'nullable',
            'leader_phone' => 'required|digits:11',
            'location' => 'required|max:255',
            'leader_cnic' => 'required|regex:/^[0-9]{5}-[0-9]{7}-[0-9]{1}$/',
            'password' => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'banner' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $community->name = $request->name;
        $community->email = $request->email;
        $community->category = $request->category;
        $community->description = $request->description;
        $community->rules = $request->rules;
        $community->leader_phone = $request->leader_phone;
        $community->location = $request->location;
        $community->leader_cnic = $request->leader_cnic;

        if ($request->filled('password')) {
            $community->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/communities'), $filename);
            $community->image = $filename;
        }

        if ($request->hasFile('banner')) {
            $file = $request->file('banner');
            $bannerName = time().'_banner_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/communities'), $bannerName);
            $community->banner = $bannerName;
        }

        $community->save();

        return redirect('/community/profile')
            ->with('success', 'Community profile updated successfully!');
    }

}