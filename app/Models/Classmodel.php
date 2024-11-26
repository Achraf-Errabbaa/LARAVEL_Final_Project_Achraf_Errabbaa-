<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classmodel extends Model
{
    use HasFactory; 

    protected $fillable = ['name', 'max_participants', 'category' ,'start', 'end'];  

    public function courses()  
    {  
        return $this->hasMany(Course::class,'class_id');  
    }
    public function users()
{
    return $this->belongsToMany(User::class, 'class_user', 'classmodel_id', 'user_id')->withTimestamps();
} 



}
