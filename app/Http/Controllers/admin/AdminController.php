<?php

namespace App\Http\Controllers\admin;

use App\Order;
use App\Category;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jdf=new \App\lib\Jdf();
        $date_list=array();
        $total_price=array();
        $order_count=array();
        for($i=29;$i>=0;$i--){
            if($i==0){
                $string='today';
                $time=strtotime($string);
                $year=jdate($time)->format('Y');
                $month=jdate($time)->format('n');
                $day=jdate($time)->format('d');
               
                
                $date=$year.'-'.$month.'-'.$day;
                $total_price[$i]=Order::where(['date'=>$date,'payment_status'=>'ok'])->sum('price');
                $order_count[$i]=Order::where(['date'=>$date,'payment_status'=>'ok'])->count();
                $date_list[$i]=$year.'-'.$month.'-'.$day;
            }
            else{
                $string='-'.$i.' day';
                $time=strtotime($string);
                $year=jdate($time)->format('Y');
                $month=jdate($time)->format('n');
                $day=jdate($time)->format('d');
                $date=$year.'-'.$month.'-'.$day;
                $total_price[$i]=Order::where(['date'=>$date,'payment_status'=>'ok'])->sum('price');
                $order_count[$i]=Order::where(['date'=>$date,'payment_status'=>'ok'])->count();
                $date_list[$i]=$year.'-'.$month.'-'.$day;
            }
        }
        $m_t=$jdf->jmktime(0,0,0,1, $jdf->jdate('m'), $jdf->jdate('Ys'));
        $y_t=$jdf->jmktime(0,0,0,1, 1, $jdf->jdate('Ys'));
        $month_price=Order::where('time','>=',$m_t)->where('payment_status','ok')->sum('price');
        $year_price=Order::where('time','>=',$y_t)->where('payment_status','ok')->sum('price');
        
        return view('admin.index',compact('date_list','total_price','order_count','month_price','year_price'));
    }
    public function statistics()
    {
        $total_view=array();
        $view=array();
        $date=array();
        for($i=29;$i>=0;$i--){
            if($i==0){
                $string='today';
                $time=strtotime($string);
                $year=jdate($time)->format('Y');
                $month=jdate($time)->format('n');
                $day=jdate($time)->format('d');
                $row=DB::table('statistics')->where(['year'=>$year,'month'=>$month,'day'=>$day])->first();
                $date[$i]=$year.'-'.$month.'-'.$day;
                if($row){
                    $view[$i]=$row->view;
                    $total_view[$i]=$row->total_view;
                }
                else{
                    $view[$i]=0;
                    $total_view[$i]=0;  
                }
            }
            else{
                $string='-'.$i.' day';
                // dd($string);
                $time=strtotime($string);
                $year=jdate($time)->format('Y');
                $month=jdate($time)->format('n');
                $day=jdate($time)->format('d');
                // dd(jdate($time)->format('Y-n-d'));
                $row=DB::table('statistics')->where(['year'=>$year,'month'=>$month,'day'=>$day])->first();
                $date[$i]=$year.'-'.$month.'-'.$day;
                if($row){
                    $view[$i]=$row->view;
                    $total_view[$i]=$row->total_view;
                }
                else{
                    $view[$i]=0;
                    $total_view[$i]=0;  
                }
            }
        }
        return view('admin/statistics',compact('view','total_view','date'));
    }
    public function setting_form()
    {
            $data=array();
            $option_name=['terminalid','username','password'];
            foreach($option_name as $value){
                $row=DB::table('settings')->where(['option_name'=>$value])->first();
                if($row){
                    $data[$value]=$row->option_value;
                }
                else{
                    $data[$value]='';
                }
            }
        
        return view('admin.setting_form',compact('data'));

    }
    public function setting(Request $request)
    {
        $data=array();
        foreach($request->all() as $key=>$value){
            if($key!='_token'){
                $row=DB::table('settings')->where(['option_name'=>$key])->first();
                if($row){
                    $row=DB::table('settings')->where(['option_name'=>$key])->update(['option_name'=>$key,'option_value'=>$value]);
                    $data[$key]=$value;
                }
                else{
                    $row=DB::table('settings')->insert(['option_name'=>$key,'option_value'=>$value]);
                    $data[$key]=$value;
                }
            }
        }
        
        return view('admin.setting_form',compact('data'));

    }
}
