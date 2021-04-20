<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {

        $order=Order::search($request->all());
        $email=$request->email;
        $order_number=$request->order_nember;
        
        return view('order.index',compact('order','email','order_number'));
    }
    public function show($id){
        $order=Order::findOrFail($id);
        $order->order_read='ok';
        $order->update();
        $product_id=explode(',',$order->product_id);
        $product=array();
        foreach($product_id as $key=>$value){
            if(!empty($value)){
                $product[$key]=Product::findOrFail($value);
            }
        }
        return view('order.show',compact('order','product'));
    }
    public function destroy($id){
        $order=Order::findOrFail($id);
        $order->delete();
        return redirect()->back();
    }
}
