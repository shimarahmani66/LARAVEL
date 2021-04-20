<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['cat_name', 'cat_ename','parent_id','img'];
    public function parent(){
        return $this->hasOne(Category::class,'id','parent_id');
    }
    public function getChild(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
}
