<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable = ["reply","user_id","post_id","movie_id"];
    function user(){
        return $this->belongsTo(User::class);
    }
    function movie(){
        return $this->belongsTo(Movie::class);
    }
    function post(){
        return $this->belongsTo(Post::class);
    }
}
