@extends('layouts.admin')
@section('header')
<title>مدیریت تخفیف ها</title>

@endsection

@section('content')
<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
مدیریت تخفیف ها</div>
<a class="btn btn-success mt-2 mb-2" href="{{url('admin/discounts/create')}}"> ایجاد تخفیف جدید</a>
<table class="table table-striped table-bordered">
<tr>
    <th>ردیف</th>
    <th>کد تخفیف</th>
    <th>مقدار تخفیف</th>
    <th>عملیات</th>
  </tr>
  <?php

use Illuminate\Contracts\Session\Session;

$i=1;?>
  @foreach($discounts as $key=>$value)
  <tr>
    <td>{{$i}}</td>
    <td>{{$value->discount_name}}</td>
    <td>
    {{$value->discount_value}}
    </td>
    <td class="d-flex justify-content-center">
        <a  class="text-primary" href="{{url('admin/discounts').'/'.$value->id.'/edit'}}">
            <span class="fa fa-edit">
            </span>
        </a>
        <a class="pl-3 text-danger" style="cursor: pointer;"  onclick="del_row('<?php echo $value->id; ?>','<?php echo url('admin/discounts');  ?>','<?php echo csrf_token(); ?>')">
            <span class="fa fa-remove">
            </span>
        </a>
    </td>
  </tr>
  <?php $i++;?>
  @endforeach
</table>

{{$discounts->links()}}
@endsection
@section('footer')

@endsection