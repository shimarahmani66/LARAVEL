@extends('layouts.site')

@section('header')

    <title>سفارش : {{ $order->id }}</title>
@endsection

@section('content')

    <div class="row" style="width:95%;margin:10px auto;background:white;padding-bottom: 20px;">


        <div style="width:95%;margin:40px auto">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ردیف</th>
                    <th>عنوان محصول</th>
                    <th>تعداد</th>
                    <th>هزینه محصول</th>
                </tr>

                <?php
                $i=1;
                $Jdf=new \App\lib\Jdf();
                ?>
                @foreach($order_data as $key=>$value)

                    <tr>
                        <td>{{ $i }}</td>
                        <td>@if($order->payment_status=='ok')
                        <a href="{{url('user/order'.'/'.$order->id .'/'.$value['id'])}}">{{ $value['title'] }}</a>
                        @else
                        {{ $value['title'] }}
                        @endif</td>
                        <td>{{ $value['product_number'] }}</td>
                        <td>{{ number_format($value['price']) }}</td>
                    </tr>
                    <?php
                    $i++;
                    ?>
                @endforeach

            </table>


            <p style="color:red;padding-top:20px;padding-bottom:20px">اطلاعات سفارش</p>
            <table class="table table-bordered table-striped">

                <tr>
                    <td style="width:250px">نام</td>
                    <td>{{ $order->fname }}</td>
                </tr>

                <tr>
                    <td>نام خانوادگی</td>
                    <td>{{ $order->lname }}</td>
                </tr>


                <tr>
                    <td>ایمیل</td>
                    <td>{{ $order->email }}</td>
                </tr>


                <tr>
                    <td>شماره موبایل</td>
                    <td>{{ $order->mobile }}</td>
                </tr>


                <tr>
                    <td>تاریخ ثبت سفارش</td>
                    <td>{{ $Jdf->tr_num($Jdf->jdate('H:i:m  -  Y-m-j',$order->time)) }}</td>
                </tr>

                <tr>
                    <td>وضعیت محصول</td>
                    <td>
                        @if($order->payment_status=='ok')
                            پرداخت شده
                        @else
                        معلق
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>هزینه کل </td>
                    <td>{{ number_format($order->total_price) }} ریال </td>
                </tr>

                <tr>
                    <td>هزینه پرداخت شده</td>
                    <td>{{ number_format($order->price) }} ریال </td>
                </tr>


                <tr>
                    <td>کد پستی</td>
                    <td>{{ $order->zip_code }}</td>
                </tr>

                <tr>
                    <td>آدرس پستی</td>
                    <td>{{ $order->address }}</td>
                </tr>

            </table>
        </div>

    </div>
@endsection