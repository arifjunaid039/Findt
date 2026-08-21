<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // categories table has no created_at/updated_at columns
    public $timestamps = false;

    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
