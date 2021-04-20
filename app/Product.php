<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['title','title_url','text','view_number','show_status','price','order_number','links','tag','img','course_time','download_file_number','download_file_size'];
    public static function search($data){
        
        $product=Product::orderBy('id','desc');
        $string='';
        if(sizeof($data)>0){
            if(array_key_exists('title',$data)&&array_key_exists('show_status',$data)){
                $product=$product->where('title',"like",'%'.$data['title']."%")->where('show_status',"like",'%'.$data['show_status']."%");
                $string='?title='.$data['title'].'&show_status='.$data['show_status'];
            }
        }
        $product=$product->paginate(10);
        if(!empty($string)){
            $product=$product->withPath($string);
        }
      
        return $product;

    }
}
