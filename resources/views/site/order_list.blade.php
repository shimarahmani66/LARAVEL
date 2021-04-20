@extends('layouts.site')
@section('header')
<title></title>

@endsection
@section('content')

<div style="width: 95%;margin:auto;" >
<div>سفارشات من</div>
<hr>
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
      <a class="text-primary" href="{{url('user/orders1').'/'.$value->id}}">
        <span class="fa fa-eye">
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
  @endif
</table>
</div>


@endsection