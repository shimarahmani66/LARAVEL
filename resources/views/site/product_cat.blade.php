@extends('layouts.site')
@section('content')
@if(sizeof($product)>0)
@foreach($product as $value)

<div class="col-md-4 mb-3">
    <div style="border: 1px solid #c3c3c3;background: #fff;">
        <div style="border-bottom: 1px solid #c3c3c3;">
            @if(!empty($value->img))
            <a href="{{url($value->title_url)}}"><img src="{{url($value->img)}}" class="w-100" height="250px"></a>
            @else
            <a href="{{url($value->title_url)}}"><img src="{{url('upload/index.png')}}" class="w-100" height="250px"></a>
            @endif
        </div>
        <div style="border-bottom: 1px solid #c3c3c3;">
            <a href="{{url($value->title_url)}}" style="color:black;">
                <h6 style="font-size:1rem;padding: 20px 10px;">{{$value->title}}</h6>
            </a>

        </div>

        <div class="d-flex">
            <?php $course_time = str_replace(
                array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
                array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
                $value->course_time
            );
            $price = str_replace(
                array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
                array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
                number_format($value->price)
            );
            ?>
            <div class="mr-auto" style="font-size:1rem;padding: 20px 10px;">{{$course_time}}</div>
            @if($value->price==0)
            <div class=" ml-auto btn btn-primary" style="font-size:1rem;padding: 10px 10px; margin:10px;">رایگان</div>
            @else
            <div class="ml-auto btn btn-primary" style="font-size:1rem;padding: 10px 10px; margin:10px;">{{$price }} ریال</div>
            @endif
        </div>


    </div>



</div>


@endforeach
<div class="col-md-12">
 {{$product->links()}} 
</div>
@else
<div class="alert alert-success w-100"> برای دسته بندی مورد نظر محصولی وجود ندارد</div>
@endif
@endsection
