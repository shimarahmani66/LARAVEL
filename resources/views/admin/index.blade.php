@extends('layouts.admin')
@section('header')
<title>پنل مدیریت</title>
<style>
    body{
        height:100vh;
    }
    .highcharts-figure, .highcharts-data-table table {
  min-width: 360px; 
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
	font-family: Verdana, sans-serif;
	border-collapse: collapse;
	border: 1px solid #EBEBEB;
	margin: 10px auto;
	text-align: center;
	width: 100%;
	max-width: 500px;
}
.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}
.highcharts-data-table th {
	font-weight: 600;
  padding: 0.5em;
}
.highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
  padding: 0.5em;
}
.highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}
.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
@endsection
@section('content')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<div class="bg-primary d-flex justify-content-center p-3 mt-2 form-control text-white" >
به پنل مدیریت خوش امدید</div>

<?php 

$d='';
$order_price='';
$count='';
foreach($date_list as $value){
    $d.="'$value', ";
}
foreach($total_price as $value){
    $order_price.="$value,";
}
foreach($order_count as $value){
    $count.="$value,";
}

?>

 <figure class="highcharts-figure">
  <div id="container" style="direction:ltr;"></div>

</figure> 
<table class="table table-bordered tabe-striped">
    <tr>
        <td>درآمد روزانه</td>
        <td>{{$total_price[0]}} ریال</td>
    </tr>
    <tr>
        <td>درآمد ماهانه</td>
        <td>{{number_format($month_price)}} ریال</td>
    </tr>
    <tr>
        <td>درآمد سالانه</td>
        <td>{{number_format($year_price)}} ریال</td>    </tr>
</table>


@endsection
@section('footer')

<script>
    Highcharts.chart('container', {

title: {
    text: 'میزان درآمد 30 روز اخیر'
},

subtitle: {
    text: ''
},
chart: {
    style: {
        fontFamily: 'yekan',
    }
},

yAxis: {
    title: {
        text: ''
    }
},

xAxis: {
    
        categories: [<?php echo $d?>]
    },

legend: {
    layout: 'horizental',
    align: 'center',
    verticalAlign: 'top'
},
tooltip:{
formatter:function(){
    if(this.series.name=='میزان درآمد'){
        return this.x+'<br>'+' میزان درآمد:' +this.y;
    }
    else{
        return this.x+'<br>'+' تعداد تراکنش:' +this.y;
    }
}
},



series: [{
    name: 'میزان درآمد',
    data: [<?php echo $order_price?>],},{
    name: 'تعداد تراکنش',
    data: [<?php echo $count?>],
    marker:{symbol:'circle'},
    color:'red'
}],

responsive: {
    rules: [{
        condition: {
            maxWidth: 500
        },
        chartOptions: {
            legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
            }
        }
    }]
}

});
</script>

@endsection