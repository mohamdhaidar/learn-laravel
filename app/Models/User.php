<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        "name",
        "email",
        "password"
    ];

    public function profile(){
        return $this->hasone(Profile::class);
    }

    public function tasks (){
        return $this->hasMany(Task::class);
    }
    
}
