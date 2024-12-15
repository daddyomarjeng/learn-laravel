<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = ["title", "content"];

    public function author() {
        return $this->belongsTo(User::class, "user_id");
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }


}