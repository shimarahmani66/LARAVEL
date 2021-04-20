@extends('layouts.admin')
@section('header')
<title>مدیریت نظرات</title>
<style>
     body{
        height:100vh;
    } 
</style>
@endsection
@section('content')

<div class="col-md-12 mt-3">
    <div class="bg-secondary d-flex justify-content-center p-3 mt-2 form-control text-white">نظرات ثبت شده</div>
    <div class="border p-2">
        @if(Session::get('msg'))
        <div class="alert alert-primary mt-2">{{Session::get('msg')}}</div>
        @endif
        @if(sizeof($comment)==0)
        <div>تا کنون نظری ثبت نشده است</div>
        @else
        @foreach($comment as $value)

        <div id="comment_box_<?php echo $value->id; ?>" class="d-flex <?php echo ($value->status == 1) ? 'bg-primary' : 'bg-danger' ?> p text-white mt-2">
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


            <div class="btn btn-info p-2 mt-2 text-white">ثبت شده برای محصول :{{$value->product->title}}</div>
            @if($value->parent_id!=0)<div class="btn btn-info p-2 mt-2 text-white">در پاسخ به <?php $parent = $value->getParent ?>{{$parent->name}}</div> @endif

            <div class="btn <?php echo ($value->status == 1) ? 'bg-info' : 'bg-danger' ?>  mt-3 ml-3 text-white" id="status_text_<?php echo $value->id; ?>" onclick="set_status('{{$value->id}}')">
                @if($value->status==1)
                تایید شده
                @else
                تایید نشده
                @endif
            </div>
            <div class="btn btn-info mt-3 ml-3 text-white" onclick="add_answer('{{$value->id}}')">ارسال پاسخ</div>

            <a class="btn btn-danger mt-3 ml-3 text-white" style="cursor: pointer;" onclick="del_row('<?php echo $value->id; ?>','<?php echo url('admin/comment');  ?>','<?php echo csrf_token(); ?>')">حذف پیام</a>
            <div style="  visibility: hidden;height:0;" id="add_comment_form_<?php echo $value->id ?>">

                {!! Form::open(['url' => 'admin/comment/create']) !!}
                @if($value->parent_id==0)
                <input type="hidden" value="<?php echo $value->id ?>" name="parent_id" id="parent_id">
                @else
                <input type="hidden" value="<?php echo $parent->id ?>" name="parent_id" id="parent_id">
                @endif
                <input type="hidden" value="{{$value->product_id}}" name="product_id">
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

        @endforeach
        @endif

    </div>
    <div class="mt-2">    {{$comment->links()}}</div>


</div>
@endsection
@section('footer')
<script>
    set_status = function(id) {
        //   alert(id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var number=document.getElementById('status_text_'+id).value;
        // alert(number);
        $.ajax({

            url: '{{url("admin/set_status")}}',
            type: 'POST',
            data: 'id=' + id,
            success: function(data) {
                // alert(data.value);
                if (data == "1") {

                    $('#status_text_' + id).html('تایید شده');
                    document.getElementById('comment_box_' + id).classList.remove("bg-danger");
                    document.getElementById('comment_box_' + id).classList.add("bg-primary");
                    document.getElementById('status_text_' + id).classList.remove("bg-danger");
                    document.getElementById('status_text_' + id).classList.add("bg-info");
                } else {
                    $('#status_text_' + id).html('تایید نشده');
                    document.getElementById('comment_box_' + id).classList.remove("bg-primary");
                    document.getElementById('comment_box_' + id).classList.add("bg-danger");
                    document.getElementById('status_text_' + id).classList.remove("bg-info");
                    document.getElementById('status_text_' + id).classList.add("bg-danger");
                }

            }
        });

    };
    add_answer = function(id) {
        x = document.getElementById('add_comment_form_' + id);
        if (x.style.visibility === "hidden") {
            x.style.visibility = 'visible';
            x.style.height = '100%';
        } else {
            x.style.visibility = 'hidden';
            x.style.height = '0';
        }
    }
</script>
@endsection