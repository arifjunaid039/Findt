<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Community extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'category', 'rules',
        'leader_phone', 'location', 'privacy', 'banner', 'leader_id',
        'leader_cnic', 'password', 'email', 'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function index(Request $request): View
{
    $query = Community::with(['members', 'items'])
        ->withCount(['members', 'items']);

    if ($request->filled('location')) {
        $query->where('location', $request->location);
    }

    $communities = $query->latest()
        ->paginate(15)
        ->withQueryString();

    $locations = Community::select('location')
        ->whereNotNull('location')
        ->distinct()
        ->orderBy('location')
        ->pluck('location');

    return view('communities', [
        'communities' => $communities,
        'locations' => $locations,
    ]);
}


    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->hasMany(CommunityMember::class, 'community_id');
    }
    public function items()
{
    return $this->hasMany(Item::class, 'community_id');
}


    public function memberUsers()
    {
        return $this->belongsToMany(User::class, 'community_members', 'community_id', 'user_id')
            ->withPivot('joined_at');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    
}
