@extends('layouts.admin')
@section('header')
<title>ویرایش تخفیفات</title>
<link href="{{url('css/bootstrap-select.css')}}" rel="stylesheet">
<style>
    body{
        height:100vh;
    }
</style>
@endsection
@section('content')
<div class="bg-primary d-flex justify-content-center p-3 mt-2 form-control text-white">
ویرایش تخفیفات
</div>

{!! Form::model($discounts,['url' => 'admin/discounts'.'/'.$discounts->id]) !!}
@method('put')
<div class="form-group mt-2">
{!! Form::label('discount_name' , 'کد تخفیف:') !!}
{!! Form::text('discount_name' ,null, ['class'=>'form-control']) !!}
@if($errors->has('discount_name'))
<div class="alert alert-danger mt-1">{{$errors->first('discount_name')}}</div>

@endif
</div>
<div class="form-group mt-2">
{!! Form::label('discount_value' , 'مقدار تخفیف:') !!}
{!! Form::text('discount_value' , null, ['class'=>'form-control']) !!}
@if($errors->has('discount_value'))
<div class="alert alert-danger mt-1">{{$errors->first('discount_value')}}</div>
@endif
</div>
<div class="form-group mt-2 d-flex justify-content-center">
{!! Form::submit('ویرایش', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}

@endsection
@section('footer')


@endsection
