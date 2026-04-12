<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        "name"
    ];

    public function tasks(){
        return $this->belongsToMany(Task::class,"category_task","category_id","task_id")
            ->withTimestamps();
    }
}
