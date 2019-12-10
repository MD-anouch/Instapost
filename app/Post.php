<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    public function user(){

        return $this->BelongsTo(User::class);

    }
    public function comments(){

        return $this->hasMany(Comment::class);

    }
    public function likes(){

        return $this->belongsTo(Like::class);

    }
}
