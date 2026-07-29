<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // items table has created_at but no updated_at column
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'description', 'item_type',
        'location', 'date_occurred', 'status', 'photo', 'brand', 'color',
        'sub_type', 'sub_type_other', 'imei_number', 'serial_number',
        'verification_notes', 'contact_number',
    ];

    protected $casts = [
        'date_occurred' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function claims()
    {
        return $this->hasMany(Claim::class, 'item_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'item_id');
    }

    public function scopeLost($query)
    {
        return $query->where('item_type', 'lost');
    }

    public function scopeFound($query)
    {
        return $query->where('item_type', 'found');
    }
}
