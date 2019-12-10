<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function user(){

        return $this->BelongsTo(User::class);

    }
    public function post(){

        return $this->BelongsTo(Post::class);

    }
}
