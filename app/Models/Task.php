<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
   protected $table ="tasks";

   protected $fillable=[
      "user_id",
      "title",
      "description",
      "priority"
   ];

   public function user(){
      return $this->belongsTo(User::class);
   }        

   public function categories(){
      return $this->belongsToMany(Category::class,"category_task","task_id","category_id")
         ->withTimestamps();
   } 
}