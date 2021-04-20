<?php

namespace App\Http\Controllers\admin;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $product=Product::search($request->all());
        
        return view('product.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $array=[0=>'ایجاد سر دسته جدید'];
        // $cat_list=Category::where('parent_id',0)->get()->pluck('cat_name','id')->toArray();
        // $cat_list=$array+$cat_list;
        // //dd($cat_list);
        $cat=Category::where('parent_id',0)->get();

        return view('product.create',compact('cat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title'=>'required|unique:products',
            'price'=>'integer',
            'file'=>'mimes:jpeg,png|max:1024'
        ],[            'title.required'=>'نام عنوان نمی تواند خالی باشد ',
        'title.unique'=>' نام عنوان نمی تواند تکراری باشد ',
        'price.integer'=>'قیمت باید عدد صحیح باشد',
        'file.mimes'=>'نوع فایل باید jpeg یا png باشد',
        'file.max'=>'حجم فایل نباید بیشتر از 1 مگا بایت باشد',]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else{
            $product=new Product($request->all());
            $product->view_number=0;
            $product->order_number=0;
            $url=str_replace("-","",$product->title);
            $url=str_replace("/","",$url);
            $product->title_url=preg_replace("/\s+/","-",$url);
            if($request->hasFile('file')){
                $file_name=time().".".$request->file('file')->getClientOriginalExtension();
                if($request->file("file")->move("upload",$file_name)){
                    $product->img="upload/".$file_name;
                }
            }
            $cat=$request->get('product_name');
            
            if($product->save()){
                if(is_array($cat)){
                    foreach($cat as $value){DB::table('product_category')->insert(['product_id'=>$product->id,'category_id'=>$value]);}             
                }
                return redirect()->route('product.index');  
            }
            else{
                return redirect()->back();
            }
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $cat=Category::where('parent_id',0)->get();
        $product_cat=DB::table('product_category')->where('product_id',$product->id)->pluck('id','category_id')->toArray();

        return view('product.update',compact('cat','product','product_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
            $url=str_replace("-","",$request->title);
            $url=str_replace("/","",$url);
            $product->title_url=preg_replace("/\s+/","-",$url);
            if($request->hasFile('file')){
                $file_name=time().".".$request->file('file')->getClientOriginalExtension();
                if(File::exists($product->img)) {
                    File::delete($product->img);
                }
                if($request->file("file")->move("upload",$file_name)){
                    $product->img="upload/".$file_name;
                }
            }
            $cat=$request->get('product_name');
            
            if($product->update($request->all())){
                if(is_array($cat)){
                    DB::table('product_category')->where('product_id',$product->id)->delete();
                    foreach($cat as $value){DB::table('product_category')->insert(['product_id'=>$product->id,'category_id'=>$value]);}             
                }
                return redirect()->route('product.index');  
            }
            else{
                return redirect()->back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        
        if(File::exists($product->img)) {
            File::delete($product->img);
        }
        DB::table('product_category')->where('product_id',$product->id)->delete();
        $product->delete();
        return redirect()->back();
    }
}
