<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Category=Category::orderBy('id','DESC')->paginate(10);
        return view('category.index',compact('Category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array=[0=>'ایجاد سر دسته جدید'];
        $cat_list=Category::where('parent_id',0)->get()->pluck('cat_name','id')->toArray();
        $cat_list=$array+$cat_list;
        //dd($cat_list);
        return view('category.create',compact('cat_list'));
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
            'cat_name'=>'required',
            'cat_ename'=>'required|unique:categories',
            'parent_id'=>'required',
        ],['cat_name.required'=>'نام دسته نمی تواند خالی باشد ',
        'cat_ename.required'=>' نام انگلیسی دسته نمی تواند خالی باشد ',
        'cat_ename.unique'=>'نام انگلیسی دسته نمی تواند تکراری باشد ',
        'parent_id.required'=>'نام سر دسته نمی تواند خالی باشد ',],[]);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }
        else{
            $category=new Category($request->all());
            //$category->parent_id=0;
            $category->save(); 
            return redirect()->route('category.index');  
        }
            // $category=new Category($request->all());
            // //$category->parent_id=0;
            // $category->save(); 
            // return redirect()->route('category.index');
            
             
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $array=[0=>'ایجاد سر دسته جدید'];
        $cat_list=Category::where('parent_id',0)->get()->pluck('cat_name','id')->toArray();
        $cat_list=$array+$cat_list;
       // dd($category);
        return view('category.update',compact('category','cat_list'));
        
        // if($category->id){}
        // else{
        //     abort('404');
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
       
        //       $validator=Validator::make($request->all(),[
        //         'cat_name'=>'required',
        //         'cat_ename'=>'required|unique:categories,cat_ename,'.$category->id,

        //         'parent_id'=>'required',
        // ],['cat_name.required'=>'نام دسته نمی تواند خالی باشد ',
        // 'cat_ename.required'=>' نام انگلیسی دسته نمی تواند خالی باشد ',
        // 'cat_ename.unique'=>'نام انگلیسی دسته نمی تواند تکراری باشد ',
        // 'parent_id.required'=>'نام سر دسته نمی تواند خالی باشد ',]);
        if($category->update($request->all())){
            return redirect()->route('category.index')->with('status', '1');
          }
        else{
            return redirect()->route('category.index')->with('status', '2');
        }
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        
        $category->delete();
        return redirect()->back();
    }
}
