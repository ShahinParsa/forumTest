<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=['body', 'user_id'];
    protected $table = 'comments';

    public function commentable()
    {
        return $this->morphTo();
    }

    public function comments(){

        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
