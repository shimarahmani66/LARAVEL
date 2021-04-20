@extends('layouts.admin')
@section('header')
<title>ویرایش محصولات</title>
<link href="{{url('css/bootstrap-select.css')}}" rel="stylesheet">



@endsection
@section('content')
<div class="bg-primary d-flex justify-content-center p-3 mt-2 form-control text-white">
    ویرایش محصولات
</div>
{!! Form::model($product,['url' => 'admin/product/'.$product->id,'files'=>true]) !!}
@method('put')
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('title' , 'عنوان محصول :' ,['class'=>'col-md-3']) !!}
        {!! Form::text('title' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

    @if($errors->has('title'))
    <div class="alert alert-danger mt-1">{{$errors->first('title')}}</div>

    @endif
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('text' , 'توضیحات محصول :' ,['class'=>'col-md-3']) !!}
        {!! Form::textArea('text' ,null, ['class'=>'ckeditor form-control w-75']) !!}
    </div>

    <!-- @if($errors->has('text'))
    <div class="alert alert-danger mt-1">{{$errors->first('text')}}</div>

    @endif -->
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('show_status' , 'وضعیت محصول:',['class'=>'col-md-3']) !!}
        {!! Form::select('show_status' ,[0=>'پیش نویس',1=>'منتشر شده'],null, ['class'=>'form-control col-md-9']) !!}

    </div>
    <!-- @if($errors->has('show'))
<div class="alert alert-danger mt-1">{{$errors->first('show')}}</div>
@endif -->
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('price' , 'هزینه محصول:' ,['class'=>'col-md-3']) !!}
        {!! Form::text('price' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

    @if($errors->has('price'))
    <div class="alert alert-danger mt-1">{{$errors->first('price')}}</div>

    @endif
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('file' , 'تصویر محصول:' ,['class'=>'col-md-3']) !!}
        {!! Form::file('file' , ['class'=>'form-control col-md-9']) !!}
    </div>

    @if($errors->has('file'))
    <div class="alert alert-danger mt-1">{{$errors->first('file')}}</div>

    @endif
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('product_name[]' , 'دسته محصول:' ,['class'=>'col-md-3']) !!}
        <ul style="list-style-type:none;">
            @foreach($cat as $value)
            <li>

                <input type="checkbox" name="product_name[]" @if(array_key_exists($value->id,$product_cat)) checked="checked" @endif value="<?php echo $value->id ?>"><span><?php echo $value->cat_name ?></span>

                <ul style="list-style-type:none;">
                    @foreach($value->getChild()->get() as $value1)
                    <li>
                        <input type="checkbox" name="product_name[]" @if(array_key_exists($value1->id,$product_cat)) checked="checked" @endif value="<?php echo $value1->id ?>"><span><?php echo $value1->cat_name ?></span>

                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>
    </div>

    @if($errors->has('file'))
    <div class="alert alert-danger mt-1">{{$errors->first('file')}}</div>

    @endif
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('download_file_number' , 'تعداد قسمت های محصول:' ,['class'=>'col-md-3']) !!}
        {!! Form::text('download_file_number' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('course_time' , 'زمان دوره:' ,['class'=>'col-md-3']) !!}
        {!! Form::text('course_time' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('download_file_size' , 'حجم دوره:' ,['class'=>'col-md-3']) !!}
        {!! Form::text('download_file_size' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('links' , 'لینک های محصول :',['class'=>'col-md-3'] ) !!}
        {!! Form::textArea('links' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>

    <!-- @if($errors->has('text'))
    <div class="alert alert-danger mt-1">{{$errors->first('text')}}</div>

    @endif -->
</div>
<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('tag' , 'تگ های محصول :',['class'=>'col-md-3'] ) !!}
        {!! Form::textArea('tag' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>
</div>


<div class="form-group mt-2 d-flex justify-content-center">
    {!! Form::submit('ثبت', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}

@endsection
@section('footer')

<script type="text/javascript" src="{{url('js/bootstrap-select.js')}}"></script>
<script type="text/javascript" src="{{url('ckeditor/ckeditor.js')}}"></script>

@endsection