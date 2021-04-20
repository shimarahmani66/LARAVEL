<?php

namespace App\Http\Controllers;
use App\Order;
use App\Product;
use App\Category;
use App\lib\Mellat_Bank;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('orders');
    }
    public function index()
    {
       
            $category=Category::where('parent_id',0)->get();
            $user_id=Auth::user()->id; 
            $orders=Order::where('user_id',$user_id)->orderby('id','desc')->paginate(10);
          
                return View::make('site.order_list',compact('orders','category'));

    }
    public function add_order(OrderRequest $request)
    {
        if(Session::has('cart') && Session::has('total_price') && Session::has('cart_price'))
        {
            $Order=new Order($request->all());
            $Order->time=time();
            $Order->date=jdate()->format('Y-n-d');
            $product_id='';
            $number_product='';
            foreach(Session::get('cart') as $key=>$value)
            {
                $product_id.=$key.',';
                $number_product.=$value.',';
            }
            $Order->product_id=$product_id;
            $Order->number_product=$number_product;
            $Order->payment_status='no';
            $Order->order_read='no';
            $Order->total_price=Session::get('total_price');
            $Order->price=Session::get('cart_price');
            $Order->user_id=Auth::user()->id;


            require_once '../app/lib/nusoap.php';

            $Mellat_Bank=new Mellat_Bank();
            $res=$Mellat_Bank->pay($Order->price);
            if($res)
            {
                $Order->RefId=$res;
                if($Order->save())
                {
                    Session::forget('cart');
                    Session::forget('total_price');
                    Session::forget('cart_price');
                    return View('site.location',['res'=>$res]);
                }

            }
            else
            {
                return View('site.location',['res'=>$res]);
            }
        }
        else
        {
            return redirect()->back();
        }

    }

    public function orders(Request $request)
    {
       $RefId=$request->get('RefId');
       $ResCode=$request->get('ResCode');
       $SaleOrderId=$request->get('SaleOrderId');
       $SaleReferenceId=$request->get('SaleReferenceId');

       require_once '../app/lib/nusoap.php';
       $mellat_bank=new Mellat_Bank();
       $Order=Order::where('Refid',$RefId)->firstOrFail();
       if($ResCode==0)
       {
           if($mellat_bank->Verify($SaleOrderId,$SaleReferenceId))
           {
            $order_data=array();

            $Order=Order::where('Refid',$RefId)->firstOrFail();
            $Order->payment_status='ok';
            $Order->saleReferenceId=$SaleReferenceId;
            $Order->update();
            $id=array();
            $n=array();
            $product_id=explode(',',$Order->product_id);
            $product_number=explode(',',$Order->number_product);
            if(is_array($product_id))
            {
                foreach ($product_id as $key=>$value)
                {
                    if(!empty($value))
                    {
                        $id[$key]=$value;
                        $n[$key]=array_key_exists($key,$product_number) ? $product_number[$key] :0;
                    }
                }
            }
            $time=time()+7*24*60*60;

            foreach ($id as $key2=>$value2)
            {
                $product=Product::find($value2);
                if($product)
                {
                    $order_data[$value2]['title']=$product->title;
                    $order_data[$value2]['price']=$product->price;
                    $order_data[$value2]['product_number']=$n[$key2];
                    // $line='';
                    // $links=$product->links;
                    // $l=explode(',',$links);
                    // if(is_array($l))
                    // {
                        // $j=1;
                        // foreach ($l as $k=>$v)
                        // {
                        //     $name=md5($v.time().'/@#%%'.$value2);
                        //     DB::table('download')->insert([
                        //         'name'=>$name,
                        //         'file'=>$v,
                        //         'time'=>$time
                        //     ]);
                        //     $url=url('download').'?file='.$name;
                        //     $line.='part '.$j.' : '.$url."\r\n";
                        //     $j++;
                        // }

                        // $text_name=md5('$%#E'.$product->id.time().'#$%').'.txt';
                        // $t_name=md5('$%E'.$product->id.time().'#$%');
                        // DB::table('download')->insert([
                        //     'name'=>$t_name,
                        //     'file'=>'text_file/'.$text_name,
                        //     'time'=>$time,
                        //     'product_id'=>$product->id,
                        //     'order_id'=>$Order->id
                        // ]);

                        // $order_data[$value2]['link']=$l;
                        Cache::put('time', $time, now()->addMinutes(10080));

                        // $fopen=fopen('text_file/'.$text_name,'w');
                        // fputs($fopen,$line);
                        // fclose($fopen);
                    // }
                }
            }
            $category=Category::where('parent_id',0)->get();

            return View('site.orders',['order'=>$Order,'order_data'=>$order_data,'category'=>$category]);
        }
        else
        {
            return View('site.error_payment');
        }
    }
    else
    {
        return View('site.error_payment');
    }


 }
 public function orders1($id)
 {
    
    
    $Order=Order::where('id',$id)->firstOrFail();
    $order_data=array();

    // $Order=Order::where('Refid',$RefId)->firstOrFail();
    // $Order->payment_status='ok';
    // $Order->saleReferenceId='';
    // $Order->update();
    $id=array();
    $n=array();
    $product_id=explode(',',$Order->product_id);
    $product_number=explode(',',$Order->number_product);
    if(is_array($product_id))
    {
        foreach ($product_id as $key=>$value)
        {
            if(!empty($value))
            {
                $id[$key]=$value;
                $n[$key]=array_key_exists($key,$product_number) ? $product_number[$key] :0;
            }
        }
    }
    $time=time()+7*24*60*60;

    foreach ($id as $key2=>$value2)
    {
      
        $product=Product::find($value2);
        if($product)
        {
            $order_data[$value2]['title']=$product->title;
            $order_data[$value2]['price']=$product->price;
            $order_data[$value2]['product_number']=$n[$key2];
            $order_data[$value2]['id']=$value2;
            // $line='';
            // $links=$product->links;
            // $l=explode(',',$links);
            // if(is_array($l))
            // {
                // $j=1;
                // foreach ($l as $k=>$v)
                // {
                //     $name=md5($v.time().'/@#%%'.$value2);
                //     DB::table('download')->insert([
                //         'name'=>$name,
                //         'file'=>$v,
                //         'time'=>$time
                //     ]);
                //     $url=url('download').'?file='.$name;
                //     $line.='part '.$j.' : '.$url."\r\n";
                //     $j++;
                // }

                // $text_name=md5('$%#E'.$product->id.time().'#$%').'.txt';
                // $t_name=md5('$%E'.$product->id.time().'#$%');
                // DB::table('download')->insert([
                //     'name'=>$t_name,
                //     'file'=>'text_file/'.$text_name,
                //     'time'=>$time,
                //     'product_id'=>$product->id,
                //     'order_id'=>$Order->id
                // ]);

                // $order_data[$value2]['link']=$l;
                Cache::put('time', $time, now()->addMinutes(10080));

                // $fopen=fopen('text_file/'.$text_name,'w');
                // fputs($fopen,$line);
                // fclose($fopen);
            // }
        }
    }
    $category=Category::where('parent_id',0)->get();

    return View('site.orders',['order'=>$Order,'order_data'=>$order_data,'category'=>$category]);




}
    public function order(Request $request){
        // dd($request->order_id);
         $Order=Order::where('id',$request->order_id)->firstOrFail();
        //  dd(Cache::has('time'));
         if($Order->payment_status=="ok"&&Cache::has('time')){
            // dd(Cache::has('time'));
            // $id=$request->product_id;
            // $id=array();
            // $n=array();
            // $product_id=explode(',',$Order->product_id);
            // $product_number=explode(',',$Order->number_product);
            // if(is_array($product_id))
            // {
            //     foreach ($product_id as $key=>$value)
            //     {
            //         if(!empty($value))
            //         {
            //             $id[$key]=$value;
            //             $n[$key]=array_key_exists($key,$product_number) ? $product_number[$key] :0;
            //         }
            //     }
            // }
            $time=Cache::get('time');
            // dd($time);
    
            // foreach ($id as $key2=>$value2)
            // {
                // dd($request->product);
                $product=Product::where('id',$request->product)->firstOrFail();
                // dd($product);
                if($product)
                {
                    
                    // $order_data[$value2]['title']=$product->title;
                    // $order_data[$value2]['price']=$product->price;
                    // $order_data[$value2]['product_number']=$n[$key2];
                    $line='';
                    $l=$product->download_file_number;
                 //    $l=explode(',',$links);
                 //    if(is_array($l))
                 //    {
                     //    $j=1;
                     
                        for ($i=1;$i<=$l;$i++)
                        {
                            $name = hash('md5', $product->title.'.@#$*&^.' . $i);
                            // DB::table('download')->insert([
                            //     'name'=>$name,
                            //     'type'=>$product->id,
                            //     'time'=>$time
                            // ]);
                            $url="http://localhost:81/download-folder/".'?part='.$i.'&time='.$time.'&token='.$name.'&type='.$product->id;
                            $a[$i]=$url;
                            // $line.='part '.$i.' : '.$url. '<br>' ;
                         //    $j++;
                        }
                        // $line='<html>'.$line.'</html>';
    
                     //    $text_name=md5('$%#E'.$product->id.time().'#$%').'.txt';
                     //    $t_name=md5('$%E'.$product->id.time().'#$%');
                     //    DB::table('download')->insert([
                     //        'name'=>$t_name,
                     //        'file'=>'text_file/'.$text_name,
                     //        'time'=>$time,
                     //        'product_id'=>$product->id,
                     //        'order_id'=>$Order->id
                     //    ]);
    
                        // $order_data[$value2]['link']=$line;
    
                     //    $fopen=fopen('text_file/'.$text_name,'w');
                     //    fputs($fopen,$line);
                     //    fclose($fopen);
                 //    }
                // }
            }
            return view('site.order',compact('a'));
         }
         else{
return View('site.error_payment');
         }

    }
}
