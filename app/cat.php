<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\sub_cat;

class cat extends Model
{
    //
    protected $fillable = ['name'];
    public $table = "cat";

    public function sub_cat(){
        return $this->hasMany(sub_cat::class, 'cat_id');
    }

    public static function listAllCats(){
        $categories = cat::all();
        return $categories;
    }


    public function catsTopicsCount(){

        $count =  $this->hasManyThrough(Topic::class,sub_cat::class,'cat_id', 'sub_cat_id','id', 'id');

        return $count->count();
    }

}