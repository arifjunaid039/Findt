<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image'
    ];

    public function members()
    {
        return $this->belongsToMany(
            User::class,
            'community_members',
            'community_id',
            'user_id'
        );
    }
}