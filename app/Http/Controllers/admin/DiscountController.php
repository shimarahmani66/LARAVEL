<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use Illuminate\Support\Facades\Validator;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts=Discount::orderBy('id','DESC')->paginate(10);
        return view('discounts.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        // $validator=Validator::make($request->all(),[
        //     'discount_name'=>'required',
        //     'discount_value'=>'required|integer']);
        // if($validator->fails()){
        //     return redirect()->back()->withInput()->withErrors($validator);
        // }
        // else{
            $discounts=new Discount($request->all());
            //$category->parent_id=0;
            $discounts->save(); 
            return redirect()->route('discounts.index');  
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discounts=Discount::findOrFail($id);
        return view('discounts.update',compact('discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountRequest $request, $id)
    {
        $discounts=Discount::findOrFail($id);
        $discounts->update($request->all());
        return redirect()->route('discounts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $discounts=Discount::findOrFail($id);
        $discounts->delete();
        return redirect()->back();
    }
}
