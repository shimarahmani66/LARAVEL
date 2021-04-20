<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{url('css/app.css')}}" rel="stylesheet">
    <link href="{{url('css/admin.css')}}" rel="stylesheet">
    <link href="{{url('css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{url('fonts/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <style>
        .dropdown:hover>.dropdown-menu {
            display: block;
        }
        body{
            font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
        }
    </style>
    @yield('header')

</head>

<body style="font-family:yekan;">
    <div class="container">
        <div class="row">
            <div class="col-md-8" style="padding: 30px; background-color:white;">
                <div>
                    <p>
                        <a href="#" style="font-size: 25px;">آموزشیار</a>
                    </p>
                    <p style="font-size: 15px;">مرجع بروزترین آموزش ها در زمینه مهندسی کامپیوتر</p>
                </div>
            </div>
            <div class="col-md-4" style="padding: 30px; background-color:white;">
                <div style="padding: 30px;">
                    @if(!Auth::check())
                    <a href="{{url('login')}}" class="btn btn-success" style="margin-left: 15px;">ورود به سایت</a>
                    <a href="{{url('register')}}" class="btn btn-warning">ثبت نام در سایت</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <nav class="navbar navbar-expand-sm bg-primary navbar-light w-100">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link text-light" style="font-size:15px" href="{{url('')}}">خانه</a>
                    </li>


                    @foreach($category as $key=>$value)
                    <li class="nav-item pl-2">
                        <div class="dropdown  show">
                            <a href="{{url('category').'/'.$value->cat_ename}}" style="font-size:15px" class="btn text-white">{{$value->cat_name}}<span class="fa fa-angle-down fa-sm text-white" style="margin-right:5px;"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="background-color: white;">
                                @if($value->getChild)
                                @foreach($value->getChild as $value2)
                                <a class="dropdown-item" href="{{url('category').'/'.$value->cat_ename.'/'.$value2->cat_ename}}">{{$value2->cat_name}}</a>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </li>
                    @endforeach
                    @if(Auth::check())
                    <li class="nav-item active">
                        <a class="nav-link text-light" style="font-size:15px" href="{{url('user')}}">پنل کاربری</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link text-light" style="font-size:15px" href="{{url('cart')}}">سبد خرید</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-light" style="font-size:15px" href="#">درباره ما </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" style="font-size:15px" href="#">تماس با ما</a>
                    </li>
                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-light" style="font-size:15px" href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">خروج</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>

        <div class="row " style="height:100%;">

            <div class="col-md-12 bg-light w-100">
                <div class="row pt-3 pb-3" style="background-color:white;">
                    @yield('content')
                </div>
            </div>
         
        </div>
        <div class="row" style="margin-top:50px;">
        <div style="background-color: #2c373b!important; height: 3px;width: 100%;"></div>
            <div class="col-md-12 bg-light">
                <div class="row pt-3 pb-3" style="background-color:white;">
                
                <div class="col-md-12">   
                <div style="text-align: center;padding-top: 20px; padding-bottom: 20px;height:100px;">
                    تمام حقوق مادی و معنوی برای سایت آموزشیار محفوظ بوده و هر گونه استفاده غیر مجاز از محتوای سایت پیگیرد قانونی دارد</div>
           
                </div></div>
             
            </div>
         
        </div>

        



    </div>
    <script src="{{url('js/app.js')}}"></script>
    <script src="{{url('js/jquery.js')}}"></script>
    <script src="{{url('js/bootstrap.js')}}"></script>
    <script src="{{url('js/js.js')}}"></script>
    
    @yield('footer')
</body>


</html>