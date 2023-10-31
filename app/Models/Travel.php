<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Travel extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }

    public function photos()
    {
        return $this->hasMany(PhotoTravel::class, 'travel');
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'travel');
    }
}
