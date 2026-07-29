<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClaimMessage extends Model
{
    protected $table = 'claim_messages';

    protected $fillable = [
        'claim_id', 'sender_id', 'message', 'read', 'is_read',
    ];

    protected $casts = [
        'read'    => 'boolean',
        'is_read' => 'boolean',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
