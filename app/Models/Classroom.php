<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    // Specify the columns that are mass-assignable
    protected $fillable = [
        'name', 'description', 'seats', 'coach_id'
    ];

    // Relationship with users (students) - Many-to-many relationship
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relationship with lessons - One-to-many relationship
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // Relationship with the coach - Many classes can belong to a single coach (1 to many)
    public function coach()
    {
        return $this->belongsTo(User::class, 'coach_id');
    }
}

