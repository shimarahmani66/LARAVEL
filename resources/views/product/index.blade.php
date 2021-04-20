@extends('layouts.admin')
@section('header')
<title>مدیریت محصولات</title>

@endsection

@section('content')

<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
  مدیریت محصولات
</div>
<div class="jumbotron">
  <h1 class="display-4 pb-3">جستجو در نتایج</h1>
  {!! Form::open(['url' => 'admin/product','files'=>true,'method'=>'GET']) !!}

<div class="form-group mt-2 w-100">
    <div class="row w-100">
        {!! Form::label('title' , 'عنوان محصول :' ,['class'=>'col-md-3']) !!}
        {!! Form::text('title' ,null, ['class'=>'form-control col-md-9']) !!}
    </div>
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
<div class="form-group mt-2 d-flex justify-content-center">
    {!! Form::submit('جستجو', ['class'=>'btn btn-success']) !!}
</div>
{!! Form::close() !!}
</div>
<a class="btn btn-success mt-2 mb-2" href="{{url('admin/product/create')}}"> ایجاد محصول جدید</a>
<table class="table table-striped table-bordered">
  <tr>
    <th>ردیف</th>
    <th>تصویر شاخص</th>
    <th>عنوان محصول</th>
    <th>وضعیت</th>
    <th>تعداد فروش</th>
    <th>میزان بازدید</th>
    <th>عملیات</th>

  </tr>
  <?php $i = 1; ?>
  @foreach($product as $key=>$value)
  <tr>
    <td>{{$i}}</td>
    <td><img src="<?php if(!empty($value->img)){echo url($value->img); } else{echo url('')."/upload/index.png";} ?>" width="50px" height="50px"></td>
    <td>{{$value->title}}</td>

    <td>@if($value->show_status==1)
      <a class="btn btn-success">منتشر شده</a>
      @else
      <a class="btn btn-warning">پیش نویس</a>
      @endif
    </td>
    <td>{{$value->order_number}}</td>
    <td>{{$value->view_number}}</td>

    <td>
      <a class="text-primary" href="{{url('admin/product').'/'.$value->id.'/edit'}}">
        <span class="fa fa-edit">
        </span>
      </a>
      <a class="pl-3 text-danger" style="cursor: pointer;" onclick="del_row('<?php echo $value->id; ?>','<?php echo url('admin/product');  ?>','<?php echo csrf_token(); ?>')">
        <span class="fa fa-remove">
        </span>
      </a>
    </td>
  </tr>
  <?php $i++; ?>
  @endforeach
  @if(sizeof($product)==0)
 <tr>
   <td>
     محصولی وجود ندارد
   </td>
 </tr>
  @endif
</table>

{{$product->links()}}

@endsection
@section('footer')

@endsection