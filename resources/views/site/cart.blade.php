@extends('layouts.site')
@section('content')
<div id="show" class="" style="width: 90%; margin:auto;">
@if(Session::has('cart'))
<?php

$cart_price=0;$total_price=0;?>
<table class="table table-bordered">
    <tr>
        <th>ردیف</th>
        <th>عنوان محصول</th>
        <th>تعداد</th>
        <th>هزینه</th>
        <th>حذف</th>
    </tr>
    <?php $i=1;?>
    @foreach(Session::get('cart') as $key=>$value)
    <?php $product=\App\Product::findOrFail($key);
    $price=$value*$product->price;
    $total_price+=$price;
    $cart_price+=$price;

    ?>
    <tr>
        <th>{{$i}}</th>
        <th>{{$product->title}}</th>
        <th width="10%">
            <input id="cart_input_{{$product->id}}" type="text" class="form-control"  value="{{$value}}"> 
            <a class="pl-3 text-primary" style="cursor: pointer;" onclick="set_number_order('{{$product->id}}')">
        <span class="fa fa-refresh">
        </span>
      </a>
        </th>
        <th>{{$price}}</th>
        <th> 
        <a class="pl-3 text-danger" style="cursor: pointer;" onclick="del_order('{{$product->id}}')">
        <span class="fa fa-remove">
        </span>
      </a></th>
    </tr>
    <?php $i++;?>
    @endforeach
</table>
<?php 





\Illuminate\Support\Facades\Session::put('total_price',$total_price);
if(Session::has('discount')){
    $cart_price=$cart_price-((Session::get('discount')*$cart_price)/100);
    Session::put('cart_price',$cart_price);
}
else{
    Session::put('cart_price',$cart_price);
}

?>
<div class="">هزینه کل:
    {{number_format($total_price)}}
</div>
<div class="">هزینه قابل واریز:
    {{number_format($cart_price)}}
</div>
<hr>
<div class="row">
<div class="col-md-6"> <div class="row">
<div class="col-md-6">در صورت داشتن کد تخفیف آن را وارد کنید:</div>
<input class="col-md-6 form-control" type="text" id="discount" name="discount">
</div>
</div>
<div class="col-md-6"> <div class="row">
<input type="submit" class="col-md-3 btn btn-success ml-3 mt-1" value="ارسال" onclick="send_discount()">
<span class="col-md-8 mt-2 text-danger" id="discount_msg"></span>
</div></div>
</div>

@else
<div class="d-flex justify-content-center">
سبد خرید خالی می باشد
</div>
@endif
<hr>
</div>

@if(Auth::check())
<div class="container" style="margin: 20px;font-family:yekan;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">لطفا اطلاعات زیر را کامل کنید</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('user/add_order') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="fname" class="col-md-4 col-form-label text-md-right">نام:</label>

                            <div class="col-md-6">
                                <input id="fname" type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="@if(old('fname')){{ old('fname')}}@else{{ Auth::user()->fname }}@endif" >

                                @error('fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="lname" class="col-md-4 col-form-label text-md-right">نام خانوادگی:</label>

                            <div class="col-md-6">
                                <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="@if(old('lname')){{ old('lname')}}@else{{ Auth::user()->lname }}@endif" >

                                @error('lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">ایمیل:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(old('email')){{ old('email')}}@else{{ Auth::user()->email }}@endif">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mobile" class="col-md-4 col-form-label text-md-right">شماره موبایل:</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile')}}" >

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row text-danger d-flex justify-content-center">
                            
در صورتی که تمایل دارید تا بسته به صورت پستی برایتان ارسال شود قسمت زیر را پر کنید:
                        </div>
                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">کد پستی:</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" name="zip_code" value="{{ old('zip_code')}}">

                                @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">آدرس پستی:</label>

                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" >{{ old('address')}}</textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                       
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">ادامه مسیر خرید                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div style="width: 90%; margin:auto;">
<a class="d-flex justify-content-center" href="{{url('login')}}">برای ادامه خرید باید وارد حساب کاربری خود شوید</a></div>
@endif
@endsection
@section('footer')
<!-- <script src="{{url('js/jquery.js')}}"></script> -->
<script>
    set_number_order=function(id){
        //  alert(id);
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        var number=document.getElementById('cart_input_'+id).value;
        // alert(number);
        $.ajax({
            url:'{{url("change_number")}}',
            type:'POST',
            data:'product_id='+id+'&number='+number,
            //alert(number);
            success:function(data){
                $('#show').html(data);
                 alert('ok');
            }
        });

    };
    del_order=function(id){
        //  alert(id);
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        // var number=document.getElementById('cart_input_'+id).value;
        // alert(number);
        $.ajax({
            url:'{{url("del_cart")}}',
            type:'POST',
            data:'product_id='+id,
            success:function(data){
                $('#show').html(data);
                // alert('ok');
            }
        });

    };
    send_discount=function(){
        var discount=document.getElementById('discount').value;
        if(discount.trim()==''){
            $('#discount_msg').html('لطفا کد تخفیف راوارد کنید');
        }
        else{
            $('#discount_msg').html('');
            $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        // var number=document.getElementById('cart_input_'+id).value;
        // alert(number);
        $.ajax({
            url:'{{url("set_discount")}}',
            type:'POST',
            data:'discount='+discount,
            success:function(data){
                $('#show').html(data);
                // alert('ok');
            }
        });


        }
    }
</script>
@endsection