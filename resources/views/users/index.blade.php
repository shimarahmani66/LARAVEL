@extends('layouts.admin')
@section('header')
<title>مدیریت کاربران</title>

@endsection

@section('content')
<div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">
مدیریت کاربران
</div>
<table class="table table-bordered table-striped">
    <tr>
        <th>ردیف</th>
        <th>نام</th>
        <th>نام خانوادگی</th>
        <th>ایمیل</th>
        <th>نقش کاربری</th>
        <th>عملیات</th>
    </tr>
    <?php $i=0;?>
    @foreach($users as $user)
    <tr>
        <td>{{$i}}</td>
        <td>{{$user->fname}}</td>
        <td>{{$user->lname}}</td>
        <td>{{$user->email}}</td>
        <td>@if($user->role=="admin")مدیر @else کاربر عادی @endif</td>
        <td>    
      <a class="text-primary" href="{{url('admin/users').'/'.$user->id}}">
        <span class="fa fa-eye">
        </span>
      </a>
      <a class="pl-3 text-danger" style="cursor: pointer;" onclick="del_row('<?php echo $user->id; ?>','<?php echo url('admin/users');  ?>','<?php echo csrf_token(); ?>')">
        <span class="fa fa-remove">
        </span>
      </a>
    </td>
    </tr>
    <?php $i++;?>
    @endforeach

</table>
{{$users->links()}}
@endsection