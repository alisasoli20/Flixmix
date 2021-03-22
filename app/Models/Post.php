<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ["title","description","user_id","movie_id","created_at","updated_at"];
    function movie(){
        return $this->belongsTo(Movie::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
    function replies(){
        return $this->hasMany(Reply::class);
    }
}
