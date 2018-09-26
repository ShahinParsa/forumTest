<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $guarded=[];
    public $table = "topics";
    protected $fillable = [
        'title',
        'topic_body',
        'sub_cat_id',
        'user_id',
        'img_url',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sub_cat(){
        return $this->belongsTo(sub_cat::class);

    }

    public function comments(){
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

}
