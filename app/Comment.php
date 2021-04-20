<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['name','email','content','parent_id','product_id','status'];
    protected $dateFormat = 'U';
    public function getChild(){
        return $this->hasMany(Comment::class,'parent_id','id');
    }
    public function getParent(){
        return $this->hasOne(Comment::class,'id','parent_id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
