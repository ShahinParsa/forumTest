<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class sub_cat extends Model
{
    //
    public $fillable = ['name'];
    protected $table = "sub_cat";

    public function sub_cat(){
        return $this->belongsToMany(Topic::class);
    }

    public function cat()
    {
        return $this->belongsTo(cat::class, 'cat_id');
    }

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function countTopics(){
        return $this->topic->count();
    }

    public static function listAllSubCats(){
        $subCategories = sub_cat::all();
        return $subCategories;
    }

}