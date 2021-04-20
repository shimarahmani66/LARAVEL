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
<?php 
$d='';
$v='';
$v_t='';
foreach($date as $value){
    $d.="'$value', ";
}
foreach($view as $value){
    $v.="$value,";
}
foreach($total_view as $value){
    $v_t.="$value,";
}

?>

 <figure class="highcharts-figure">
  <div id="container" style="direction:ltr;"></div>

</figure> 

@endsection
@section('footer')

<script>
    Highcharts.chart('container', {

title: {
    text: 'آمار بازدید 30 روز اخیر'
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



series: [{
    name: 'تعداد بازدید کنندگان',
    data: [<?php echo $v?>],},{
    name: 'آمار بازدید کل',
    data: [<?php echo $v_t?>],
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