<?php use Illuminate\Support\Facades\DB;?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/admin.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    @yield('header')
    <style>
        .one{
            display:block !important;
        }
        html,body{
    height: 100%;
overflow-y:hidden;
}
        .class1{
            height:calc(100vh - 55px);
            overflow-y: auto;
        } 
        .class2{
            height:calc(100vh - 55px);
            overflow-y:auto;
        } 
    </style>


 
</head>

<body>
    <?php $comment_count=DB::table('comments')->where('status',0)->count();
    if($comment_count>0){
        $comment='نظرات('.$comment_count.')';
    }
    else{
        $comment='نظرات';
    }
    ?>
    <div class="container-fluid h-100" style="font-family:yekan;">
        <div class="row" style="height:55px;">
            <div class="col-md-12 h-100 bg-dark">
                <div class="text-white p-3 d-flex justify-content-center h-100">صفحه مدیریت</div>
            </div>
        </div>

        <div class="row " style="height:90%;">
            <div class="col-md-3 bg-secondary class1">
                <div class="w-100">
                    <nav class="navbar navbar-dark bg-secondary w-100">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item dropdown dropdown1 active w-100">
                                <a class="nav-link dropdown-toggle w-100" data-toggle="dropdown" href="#"><span class="fa fa-plus-square-o p-3"></span>محصولات</a>
                                <div class="dropdown-menu dropdown-menu1">
                                    <a class="dropdown-item" href="{{route('product.index')}}">مدیریت محصول</a>
                                    <a class="dropdown-item" href="{{route('product.create')}}">محصول جدید</a>
                                    <a class="dropdown-item" href="{{route('category.index')}}">مدیریت دسته ها</a>
                                    <a class="dropdown-item" href="{{route('category.create')}}">دسته جدید</a>
                                </div>
                                <!-- <ul>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="#"><span class="fa fa-plus-square-o p-3"></span>محصول جدید</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('category.index')}}"><span class="fa fa-plus-square-o p-3"></span>مدیریت دسته ها</a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{route('category.create')}}"><span class="fa fa-plus-square-o p-3"></span>دسته جدید</a>
                                    </li>
                                </ul> -->
                            </li>
                            <li class="nav-item active dropdown dropdown2 w-100">
                                <a class="nav-link dropdown dropdown-toggle w-100" data-toggle="dropdown" href="#"><span class="fa fa-plus-square-o p-3"></span>سفارشات</a>
                                <div class="dropdown-menu dropdown-menu2">
                                    <a class="dropdown-item" href="{{url('admin/order')}}">مدیریت سفارشات</a>
                                    <a class="dropdown-item" href="{{route('discounts.index')}}">کدهای تخفیف</a>
                                </div>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('admin/comment')}}"><span class="fa fa-plus-square-o p-3"></span>{{$comment}}</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('admin/statistics')}}"><span class="fa fa-plus-square-o p-3"></span>آمار سایت</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('admin/users')}}"><span class="fa fa-plus-square-o p-3"></span>مدیریت کاربران</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{url('admin/setting')}}"><span class="fa fa-plus-square-o p-3"></span>تنظیمات</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <span class="fa fa-plus-square-o p-3"></span>خروج </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                <!-- <a class="nav-link" href="#"><span class="fa fa-plus-square-o p-3"></span>خروج</a> -->
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-md-9 bg-light h-100 class2">
                <div class="h-100">
                    @yield('content')
                </div>
            </div>

        </div>


    </div>
    <script src="{{url('js/app.js')}}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script> -->
    <script src="{{url('js/jquery.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script> 
    <script src="{{url('js/bootstrap.js')}}"></script>
    <script src="{{url('js/js.js')}}"></script>


    @yield('footer')
    <!-- <script>
         
         $(".dropdown1").click(function(){
             
   $(".dropdown-menu1").toggleClass("one");
 });
 
 $(".dropdown2").click(function(){
             
             $(".dropdown-menu2").toggleClass("one");
           });
</script> -->
</body>


</html>