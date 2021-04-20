@extends('layouts.admin')
@section('header')
<title>اطلاعات کاربر</title>

@endsection

@section('content')
<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
اطلاعات کاربر- {{$user->fname}}
</div>
<table class="table table-bordered table-striped">
    <tr>
        <td>نام</td>
        <td>{{$user->fname}}</td>
    </tr>
    <tr>
        <td>نام خانوادگی</td>
        <td>{{$user->lname}}</td>
    </tr>
    <tr>
        <td>ایمیل</td>
        <td>{{$user->email}}</td>
    </tr>
    <tr>
        <td>نقش کاربری</td>
        <td>@if($user->role=="admin")مدیر @else کاربر عادی @endif</td>
    </tr>
    <tr>
        <td>جمع کل خرید</td>
        <td>{{number_format($price)}} ریال</td>
    </tr>
</table>
<div class="d-flex justify-content-center p-3 mt-2 form-control mb-3">
سفارش کاربر
</div>
<table class="table table-striped table-bordered">
  <tr>
    <th>ردیف</th>
    <th>شماره سفارش</th>
    <th>ایمیل</th>
    <th>زمان سفارش</th>
    <th>وضعیت</th>
    <th>عملیات</th>

  </tr>
  <?php $i = 1; ?>
  @foreach($orders as $key=>$value)
  <tr>
    <td>{{$i}}</td>
    @if($value->order_read=="no")
    <td class="text-danger">{{$value->time}}</td>
    @else
    <td>{{$value->time}}</td>
    @endif
    <td>{{$value->email}}</td>

    <td>{{jdate($value->time)->format("Y-n-d  -  H:i:s")}}</td>
    @if($value->payment_status=="no")
    <td>معلق</td>
    @else
    <td>پرداخت شده</td>
    @endif

    <td>
      <a class="text-primary" href="{{url('admin/order').'/'.$value->id}}">
        <span class="fa fa-eye">
        </span>
      </a>
      <a class="pl-3 text-danger" style="cursor: pointer;" onclick="del_row('<?php echo $value->id; ?>','<?php echo url('admin/order');  ?>','<?php echo csrf_token(); ?>')">
        <span class="fa fa-remove">
        </span>
      </a>
    </td>
  </tr>
  <?php $i++; ?>
  @endforeach
  @if(sizeof($orders)==0)
 <tr>
   <td colspan="6">
     محصولی وجود ندارد
   </td>
 </tr>
 @else
 
  @endif
</table>
@endsection