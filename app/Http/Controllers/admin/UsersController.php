<?php

namespace App\Http\Controllers\admin;

use App\User;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UsersController extends Controller
{
    public function index(Request $request)
    {

        $users=User::orderby('id','desc')->paginate(10);
        return view('users.index',compact('users'));
    }
    public function show($id){
        $user=User::findOrFail($id);
        $orders=Order::where('user_id',$user->id)->get();
        $price=Order::where(['user_id'=>$user->id,'payment_status'=>'ok'])->sum('price');
        return view('users.show',compact('user','orders','price'));
    }
    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->back();
    }
}
