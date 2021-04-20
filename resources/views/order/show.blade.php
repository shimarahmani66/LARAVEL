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
    <td>نام</td>
    <td>{{$order->fname}}</td>
  </tr>
  <tr>
    <td> نام خانوادگی</td>
    <td>{{$order->lname}}</td>
  </tr>
  <tr>
    <td> ایمیل </td>
    <td>{{$order->email}}</td>
  </tr>
  <tr>
    <td> موبایل </td>
    <td>{{$order->mobile}}</td>
  </tr>
  <tr>
    <td> کد پستی </td>
    <td>{{$order->zip_code}}</td>
  </tr>
  <tr>
    <td> آدرس پستی </td>
    <td>{{$order->address}}</td>
  </tr>

</table>
<div>محصولات خریداری شده:</div>
<table class="table table-bordered">
  <tr>
    <th>ردیف</th>
    <th>عنوان محصول</th>
    <th>هزینه محصول</th>
    <th>تعداد محصول</th>
  </tr>
  <?php $number=explode(',',$order->number_product);$i=1;?>
  @foreach($product as $key=>$value)
  @if($value)
  <tr>
    <td>{{$i}}</td>
    <td>{{$value->title}}</td>
    <td>{{number_format($value->price)}} ریال</td>
    <td>
      <?php if(array_key_exists($key,$number)){
        echo $number[$key];
      }?>
    </td>

  </tr>
  @endif
  <?php $i++;?>
  @endforeach
</table>



@endsection
@section('footer')

@endsection