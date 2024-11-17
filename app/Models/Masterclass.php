<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masterclass extends Model
{
    protected $fillable = [
        'title', 'premium', 'creator_id'
    ];
}
