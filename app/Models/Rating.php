<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = "rating";
    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
