<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [

        'title' , 'content', 'created_at', 'user_id', 'image_path', 'id', 'updated_at'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public  function Comments()
    {
      return   $this->hasMany(Comment::class);
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }



}


