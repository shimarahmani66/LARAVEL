@extends('layouts.site')
@section('content')

<div class="col-md-6">
    <?php

    use Illuminate\Support\Facades\Cookie;

    $course_time = str_replace(
        array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        $product->course_time
    );
    $price = str_replace(
        array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
        array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
        number_format($product->price)
    );
    // if(isset($_COOKIE['msg'])){
    //     Session::put('msg',$_COOKIE['msg']);
    // }
    ?>
    @if(!empty($product->img))
    <div class="w-100">
        <img src="{{url($product->img)}}" width="100%" height="300px">
    </div>
    @else
    <div class="w-100">
        <img src="{{url('upload/index.png')}}" width="100%" height="300px">
    </div>
    @endif
</div>
<div class="col-md-6">
    <div class="w-100 mb-3">
        <div class="w-100">نام دوره:
            {{$product->title}}
        </div>
    </div>
    <div class="w-100  mb-3">
        <div class="w-100">نام مدرس:
            شیما رحمانی
        </div>
    </div>
    <div class="w-100  mb-3">
        <div class="w-100">تعداد قسمت های دوره:
            {{$product->download_file_number}}
        </div>
    </div>
    <div class="w-100  mb-3">
        <div class="w-100">مدت زمان دوره:
            {{$course_time}}
        </div>
    </div>
    <div class="w-100  mb-3">
        <div class="w-100">حجم دوره:
            {{$product->download_file_size}}
        </div>
    </div>
    <div class="w-100  mb-3">
        <div class="w-100">هزینه دوره:
            @if($product->price==0)
            رایگان
            @else
            {{$price.'ریال'}}
            @endif
        </div>
    </div>
    @if($product->price==0)
    <a href="#" class="btn btn-success">رفتن به صفحه دانلود</a>
    @else
    <form method="POST" action="{{url('cart')}}">
        @csrf
        <input type="hidden" name="product_id" value="{{$product->id}}">
        <input type="hidden" name="view_number" value="{{$product->view_number}}">
        <input type="hidden" name="all_deleted" value="1">
        <?php Session::put('all_deleted', 1) ?>
        <button type="submit" class="btn btn-success">افزودن به سبد خرید</button>
    </form>

    @endif
</div>

<div class="col-md-12">
    {{$product->text}}
</div>
<div class="col-md-12 mt-3">
    <div class="bg-dark p-3 text-white">
        ارسال نظر
    </div>
    <div class="border p-3" id="add_comment_form">

        {!! Form::open(['url' => 'add_comment']) !!}
        <input type="hidden" value="0" name="parent_id" id="parent_id">
        <input type="hidden" value="{{$product->id}}" name="product_id">

        <div>
            @if(Session::get('msg'))
            <div class="alert alert-primary">{{Session::get('msg')}}</div>
            @endif

            <div id="msg_tag"></div>


        </div>

        <div class="form-group mt-2">
            <div class="row">
                {!! Form::label('name' , 'نام و نام خانوادگی:',['class'=>'col-md-3']) !!}
                <div class="col-md-9">{!! Form::text('name' ,null, ['class'=>'form-control']) !!}</div>
                @if($errors->has('name'))
                <div class="alert alert-danger mt-1">{{$errors->first('name')}}</div>

                @endif
            </div>
        </div>
        <div class="form-group mt-2">
            <div class="row">
                {!! Form::label('email' , 'ایمیل:',['class'=>'col-md-3']) !!}
                <div class="col-md-9">
                    {!! Form::text('email' , null, ['class'=>'form-control']) !!}</div>
                @if($errors->has('email'))
                <div class="alert alert-danger mt-1">{{$errors->first('email')}}</div>
                @endif
            </div>
        </div>
        <div class="form-group mt-2">
            <div class="row">
                {!! Form::label('content' , 'متن پیام:',['class'=>'col-md-3']) !!}
                <div class="col-md-9">
                    {!! Form::textArea('content' , null, ['class'=>'form-control']) !!}</div>
                @if($errors->has('content'))
                <div class="alert alert-danger mt-1">{{$errors->first('content')}}</div>
                @endif
            </div>
        </div>

        <div class="form-group mt-2 d-flex justify-content-center">
            {!! Form::submit(' ثبت نظر', ['class'=>'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="col-md-12 mt-3">
    <div class="bg-info p-2 text-white">نظرات ثبت شده</div>
    <div class="border p-2">
        @if(sizeof($comment)==0)
        <div>تا کنون نظری برای این مطلب ثبت نشده است</div>
        @else
        @foreach($comment as $value)

        <div class="d-flex bg-primary p text-white mt-2">
            <div class="mr-auto p-2">نوشته شده توسط: {{$value->name}}</div>
            <?php
            $date = str_replace(
                array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
                array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
                jdate($value->created_at)->format('d-m-Y|H:i:s')
            );
            ?>
            <div class="p-2">تاریخ ثبت نظر:{{ $date}}</div>
        </div>
        <div class="border p-2">
            <div>{!!nl2br(strip_tags($value->content))!!}</div>
           
            @if($value->getChild)
            @foreach($value->getChild as $value2)

            <div class="d-flex bg-info p text-white mt-2">
                <div class="mr-auto p-2">نوشته شده توسط: {{$value2->name}}</div>
                <?php
                $date = str_replace(
                    array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'),
                    array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'),
                    jdate($value2->created_at)->format('d-m-Y|H:i:s')
                );
                ?>
                <div class="p-2">تاریخ ثبت نظر:{{ $date}}</div>
            </div>
            <div class="border p-2">
                <div>{!!nl2br(strip_tags($value2->content))!!}</div>
           </div>

            @endforeach
            @endif
            <div class="btn btn-danger mt-3 ml-3" onclick="add_answer('{{$value->id}}','{{$value->name}}')">ارسال پاسخ</div>
        </div>

        @endforeach
        @endif
    </div>
    <div class="mt-2">    {{$comment->links()}}</div>
</div>


@endsection
@section('footer')
<script src="{{url('js/jquery.js')}}"></script>
<script>
    add_answer = function(id, name) {
        document.getElementById('parent_id').value = id;
        var msg = "ارسال پاسخ به " + name;
        $("#msg_tag").addClass("alert alert-primary");
        $("#msg_tag").html(msg);
        window.location = '#add_comment_form';
    }
</script>
@endsection