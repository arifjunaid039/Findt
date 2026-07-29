<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationReport extends Model
{
    protected $table = 'conversation_reports';

    protected $fillable = [
        'claim_id',
        'reporter_id',
        'reason',
        'details',
        'status',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function claim()
    {
        return $this->belongsTo(Claim::class, 'claim_id');
    }
}