@extends('layouts.admin')
@section('header')
<title>مدیریت دسته ها</title>

@endsection

@section('content')
@if(session('status')==1)
<div class="d-flex justify-content-center p-3 m-2">
     <div class="bg-success d-flex justify-content-center  col-md-8">
ویرایش با موفقیت انجام شد
</div> 
</div>

@elseif(session('status')==2)
<div class="bg-danger d-flex justify-content-center p-3 m-2 form-control col-md-8">
ویرایش انجام نشد
</div>
@endif
<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
مدیریت دسته ها
</div>
<a class="btn btn-success mt-2 mb-2" href="{{url('admin/category/create')}}"> ایجاد دسته جدید</a>
<table class="table table-striped table-bordered">
<tr>
    <th>ردیف</th>
    <th>نام دسته</th>
    <th>سر دسته</th>
    <th>عملیات</th>
  </tr>
  <?php

use Illuminate\Contracts\Session\Session;

$i=1;?>
  @foreach($Category as $key=>$value)
  <tr>
    <td>{{$i}}</td>
    <td>{{$value->cat_name}}</td>
    <td>
        <?php 
        $parent=$value->parent;?>
        @if($parent)
        {{$parent->cat_name}}
        @else
        -
        @endif
    </td>
    <td class="d-flex justify-content-center">
        <a  class="text-primary" href="{{url('admin/category').'/'.$value->id.'/edit'}}">
            <span class="fa fa-edit">
            </span>
        </a>
        <a class="pl-3 text-danger" style="cursor: pointer;"  onclick="del_row('<?php echo $value->id; ?>','<?php echo url('admin/category');  ?>','<?php echo csrf_token(); ?>')">
            <span class="fa fa-remove">
            </span>
        </a>
    </td>
  </tr>
  <?php $i++;?>
  @endforeach
</table>

{{$Category->links()}}
@endsection
@section('footer')

@endsection