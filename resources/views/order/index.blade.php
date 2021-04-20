@extends('layouts.admin')
@section('header')
<title>مدیریت سفارشات</title>

@endsection

@section('content')

<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
  مدیریت سفارشات
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
  <form method="get" id="order_search_form">
  <tr>
    <td></td>
    <td><input type="text" class="form-control search_input" name="order_number" value="{{$order_number}}"></td>
    <td><input type="email" class="form-control search_input" name="email" value="{{$email}}"></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  </form>
  <?php $i = 1; ?>
  @foreach($order as $key=>$value)
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
  @if(sizeof($order)==0)
 <tr>
   <td colspan="6">
     محصولی وجود ندارد
   </td>
 </tr>
  @endif
</table>

{{$order->links()}}

@endsection
@section('footer')
<script>
    $('.search_input').on('keydown',function(event){
        if(event.keyCode==13){
            $('#order_search_form').submit();
        }
    });
</script>
@endsection