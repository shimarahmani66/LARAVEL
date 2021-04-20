<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['fname','lname','email','mobile','time','date','product_id','number_product','payment_status','RefId','saleReferenceId','zip_code','address','order_read','total_price','price'];
    public $timestamps=false;
    public static function search($data){
                
        $order=Order::orderBy('id','desc');
        $string='';
        if(sizeof($data)>0){
            if(array_key_exists('email',$data)&&array_key_exists('order_number',$data)){
                $order=$order->where('email',"like",'%'.$data['email']."%")->where('time',"like",'%'.$data['order_number']."%");
                $string='?email='.$data['email'].'&order_number='.$data['order_number'];
            }
        }
        $order=$order->paginate(10);
        if(!empty($string)){
            $order=$order->withPath($string);
        }
      
        return $order;
    }
}
