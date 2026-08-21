<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'fullname', 'email', 'phone', 'cnic', 'address',
        'photo', 'password', 'status', 'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Items posted by this user
    public function items()
    {
        return $this->hasMany(Item::class, 'user_id');
    }

    // Claims this user has made on other people's items
    public function claims()
    {
        return $this->hasMany(Claim::class, 'claimant_id');
    }

    // Reports this user has filed
    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    // Communities this user has joined
    public function communityMemberships()
    {
        return $this->hasMany(CommunityMember::class, 'user_id');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    // app/Models/User.php
public function communities()
{
    return $this->hasManyThrough(
        Community::class,
        CommunityMember::class,
        'user_id',
        'id',
        'id',
        'community_id'
    );
}
}
