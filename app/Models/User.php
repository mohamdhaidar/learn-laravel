<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


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
