@if(Session::has('cart'))
<?php $cart_price=0;$total_price=0;?>
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


Session::put('total_price',$total_price);
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
<span class="col-md-8 mt-2 text-primary" id="discount_msg">{{$error}}</span>


</div></div>
</div>
@else
<div class="d-flex justify-content-center">
سبد خرید خالی می باشد
</div>
@endif