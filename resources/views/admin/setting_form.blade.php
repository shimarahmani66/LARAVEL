@extends('layouts.admin')
@section('header')
<title>تنظیمات پرداخت</title>
<style>
    body{
        height:100vh;
    }
</style>
@endsection
@section('content')
<div class="bg-primary d-flex justify-content-center p-3 mt-2 form-control text-white" >
تنظیمات پرداخت</div>
{!! Form::open(['url' => 'admin/setting']) !!}

<div class="form-group mt-2" >
{!! Form::label('terminalid' , 'ترمینال ایدی:') !!}
{!! Form::text('terminalid' ,$data['terminalid'], ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-2">
{!! Form::label('username' , 'نام کاربری:') !!}
{!! Form::text('username' , $data['username'], ['class'=>'form-control']) !!}
</div>
<div class="form-group mt-2">
{!! Form::label('password' , 'کلمه عبور:') !!}
{!! Form::text('password' , $data['password'], ['class'=>'form-control']) !!}
</div>

<div class="form-group mt-2 d-flex justify-content-center">
{!! Form::submit('ثبت', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}


@endsection
@section('footer')


@endsection