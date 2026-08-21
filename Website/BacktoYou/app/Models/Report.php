<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    // reports table has created_at but no updated_at column
    const UPDATED_AT = null;

    protected $fillable = [
        'reporter_id', 'item_id', 'reason',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
