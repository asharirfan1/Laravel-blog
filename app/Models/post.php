<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable = [

        'title' , 'content', 'created_at', 'user_id'
    ];



    public function user()
    {
        return $this->belongsTo(user::class);
    }


}


