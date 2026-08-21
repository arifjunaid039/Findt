<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'item_id', 'claimant_id', 'message', 'status',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function claimant()
    {
        return $this->belongsTo(User::class, 'claimant_id');
    }

    public function getOwnerAttribute()
    {
        return $this->item?->user;
    }

    public function messages()
    {
        return $this->hasMany(ClaimMessage::class, 'claim_id');
    }

    public function conversation()
    {
        return $this->hasOne(Conversation::class, 'claim_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
