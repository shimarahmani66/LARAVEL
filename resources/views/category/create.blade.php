@extends('layouts.admin')
@section('header')
<title>افزودن دسته ها</title>
<link href="{{url('css/bootstrap-select.css')}}" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css"> -->

<style>
    body{
        height:100vh;
    }
</style>
@endsection
@section('content')

<div class="bg-primary d-flex justify-content-center p-3 mt-2 form-control text-white" >
افزودن دسته ها
</div>
{!! Form::open(['url' => 'admin/category']) !!}

<div class="form-group mt-2" >
{!! Form::label('cat_name' , 'نام دسته:') !!}
{!! Form::text('cat_name' ,null, ['class'=>'form-control']) !!}
@if($errors->has('cat_name'))
<div class="alert alert-danger mt-1">{{$errors->first('cat_name')}}</div>

@endif
</div>
<div class="form-group mt-2">
{!! Form::label('cat_ename' , 'نام لاتین دسته:') !!}
{!! Form::text('cat_ename' , null, ['class'=>'form-control']) !!}
@if($errors->has('cat_ename'))
<div class="alert alert-danger mt-1">{{$errors->first('cat_ename')}}</div>
@endif
</div>
<div class="form-group mt-2">
{!! Form::label('parent_id' , 'انتخاب سردسته:') !!}
{!! Form::select('parent_id' ,$cat_list, null, ['placeholder'=>'انتخاب کنید','class'=>'selectpicker form-control ml-auto','data-live-search'=>'true']) !!}
@if($errors->has('parent_id'))
<div class="alert alert-danger mt-1">{{$errors->first('parent_id')}}</div>
@endif
</div>

<div class="form-group mt-2 d-flex justify-content-center">
{!! Form::submit('ثبت', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}



@endsection
@section('footer')

<script type="text/javascript" src="{{url('js/bootstrap-select.js')}}"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script> -->
<script>$(document).ready(function(){
            $('.selectpicker').selectpicker();
        });</script>
@endsection
