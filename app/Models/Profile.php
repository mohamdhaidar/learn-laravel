<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        "user_id",
        "bio",
        "phone",
        "adress"
    ];

    public function user(){
        return $this->hasOne(User::class);
    }
}
