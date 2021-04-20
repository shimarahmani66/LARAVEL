<?php

namespace App\Http\Controllers;

use App\Comment;

use App\Product;
use App\Category;
use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function index(){
        $category=Category::where('parent_id',0)->get();
        $products=Product::where('show_status',1)->orderBy('id','desc')->paginate(9);
        return view('site.index',compact('products','category'));
    }
    public function show($title){
        $product=Product::where(['title_url'=>$title,'show_status'=>1])->firstOrFail();
        $product->increment('view_number');
        $comment=Comment::where(['product_id'=>$product->id,'status'=>1,'parent_id'=>0])->orderBy('id','desc')->paginate(9);
        $category=Category::where('parent_id',0)->get();
        return view('site.show',compact('product','comment','category'));
    }
    public function add_cart(REQUEST $request){
        $category=Category::where('parent_id',0)->get();
        
        $product_id=$request->product_id;
        $array=array();
        $array1=array();
        // if(empty(Session::get('view_number'))){
        //     $array1[$product_id]=$request->view_number;
        //     Session::put('view_number',$array1);
        // }
        //  Session::forget('cart');
           
        // $product=Product::findOrFail($product_id);
        // if($request->product_id!=null){
            //  dd(Session::get('view_number'));
           
            if(Session::has('cart')){
                if(!array_search($request->view_number,Session::get('view_number'))){
                    $array=Session::get('cart');
                
                    if(array_key_exists($product_id,$array)){
                        $array[$product_id]++;
                        Session::put('cart',$array);
                        // dd(Session::get('view_number'));
                        $array1[$product_id]=$request->view_number;
                        Session::put('view_number',$array1);
                        
                    }
                    else{
                        $array[$product_id]=1;
                        Session::put('cart',$array);
                        $array1[$product_id]=$request->view_number;
                        Session::put('view_number',$array1);
                    }
                }
                else{
                    // dd( Session::get('cart'));
                    return view('site.cart',compact('category'));
                }
              

            }
            else{
                // dd($request->ajax());
                if($request->all_deleted==Session::get('all_deleted')){
                    $array[$product_id]=1;
                    Session::put('cart',$array); 
                    $array1[$product_id]=$request->view_number;
                    Session::put('view_number',$array1);
                    // Session::put('all_deleted',null);
                //   dd('hi');
                }

               

            }
        
        //     $request->product_id=null;
            
        // }
        
        // dd( Session::get('cart'));

        return view('site.cart',compact('category'));

    }
    
     public function cart(){
        $category=Category::where('parent_id',0)->get();
         return view('site.cart',compact('category'));

     }
    public function change_number(Request $request){
       
        if($request->ajax()){
            $product_id=$request->product_id;
            $number=$request->number;
            settype($number,'integer');
            if(is_integer($number)&&$number>0){
                if(Session::has('cart')){
                        $array=Session::get('cart');
                    
                        if(array_key_exists($product_id,$array)){
                            $array[$product_id]=$number;
                            Session::put('cart',$array);
                            
                        }
                }

            }
            return view('site.ajax_cart');
        }
    }
    public function del_cart(Request $request){
        if($request->ajax()){
            $product_id=$request->product_id;
            // $number=$request->number;
            // settype($number,'integer');
            // if(is_integer($number)&&$number>0){
                if(Session::has('cart')){
                        $array=Session::get('cart');
                        // $array1=Session::get('view_number');
                        
                        if(array_key_exists($product_id,$array)){
                            unset($array[$product_id]);
                            // unset($array1[$product_id]);
                            
                            if(empty($array)){
                                Session::forget('cart'); 
                                // Session::forget('view_number'); 
                                 Session::put('all_deleted',0);

                            }
                            else{
                                Session::put('cart',$array);
                                // Session::put('view_number',$array1);
                            }
                        }
                }
                
            // }
            return view('site.ajax_cart');
        }
    }
    public function add_comment(CommentRequest $request){
        
        $msg="خطا در ثبت نظر";
        $product_id=$request->product_id;
        $product=Product::findOrFail($product_id);
        $comment=new Comment($request->all());
        $comment->status=0;
        if($comment->save()){
            $msg="پیام با موفقیت ثبت شد و پس از تایید مدیریت نمایش داده خواهد شد";
        }
        return redirect()->back()->with('msg',$msg);

    }
    public function cat1($cat1){
        $category=Category::where('parent_id',0)->get();
        $category1=Category::where('cat_ename',$cat1)->firstOrFail();
        $cats=DB::table('product_category')->where('category_id',$category1->id)->get();
        // dd($cats);
        $product_id=array();
        foreach($cats as $key=>$value){
            $product_id[$key]=$value->product_id;
        }
        $product=Product::where('show_status',1)->whereIn('id',$product_id)->orderBy('id','DESC')->paginate(9);
        // dd($product);
        return view('site.product_cat',compact('product','category'));
    }
    public function cat2($cat1,$cat2){
        $category=Category::where('parent_id',0)->get();
        $category1=Category::where('cat_ename',$cat1)->firstOrFail();
        $category2=Category::where('cat_ename',$cat2)->firstOrFail();
        if($category2->parent_id==$category1->id){
            $cats=DB::table('product_category')->where('category_id',$category2->id)->get();
            // dd($cats);
            $product_id=array();
            foreach($cats as $key=>$value){
                $product_id[$key]=$value->product_id;
            }
            $product=Product::where('show_status',1)->whereIn('id',$product_id)->orderBy('id','DESC')->paginate(9);
            // dd($product);
            return view('site.product_cat',compact('product','category'));
        }
        else{
            abort(404);
        }
     
    }
    public function set_discount(Request $request){
        $discount=$request->discount;
        $row=Discount::where('discount_name',$discount)->first();
        if($row){
            Session::put('discount',$row->discount_value);
            $error='کد تخفیف وارد شده صحیح می باشد';
        }
        else{
            $error='کد تخفیف وارد شده اشتباه می باشد';
        }
        return view('site.ajax_cart',compact('error'));
    }
}
