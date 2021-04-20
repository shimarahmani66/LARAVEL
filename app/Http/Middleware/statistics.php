<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class statistics
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ip=$request->ip();
        $year=jdate()->format('Y');
        $month=jdate()->format('n');
        $day=jdate()->format('d');
        $row1=null;
        $row=DB::table('statistics_user')->where(['year'=>$year,'month'=>$month,'day'=>$day,'user_ip'=>$ip])->first();
        if(!$row){
            $row1=DB::table('statistics_user')->insert(['year'=>$year,'month'=>$month,'day'=>$day,'user_ip'=>$ip]);
        }
        $row2=DB::table('statistics')->where(['year'=>$year,'month'=>$month,'day'=>$day])->first();
        if($row2){
            $view=$row2->view+1;
            $total_view=$row2->total_view+1;
            if($row1){
                DB::table('statistics')->update(['view'=>$view,'total_view'=>$total_view]);
            }
            else{
                DB::table('statistics')->update(['total_view'=>$total_view]);
            }
        }
        else{
            DB::table('statistics')->insert(['year'=>$year,'month'=>$month,'day'=>$day,'view'=>1,'total_view'=>1]);
         
        }

        return $next($request);
    }
}
