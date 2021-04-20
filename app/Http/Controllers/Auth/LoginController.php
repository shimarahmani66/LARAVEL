<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo='/';
    public function showLoginForm()
    {
        $category=Category::where('parent_id',0)->get();
        return view('auth.login',compact('category'));
    }
    protected function redirectTo(){
        $role=Auth::user()->role;
        // dd($role);
        if($role=='admin'){
            // dd($role);
            return $redirectTo='admin';
        }
        else{
            return $redirectTo='user'; 
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest.custom')->except('logout');
    }
    protected function validateLogin(Request $request)
    {
        
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            // 'captcha'=>'required|captcha'
        ],[],[
            // 'captcha'=>'تصویر امنیتی'
        ]);
    }
    public function admin_login(){
        return view('admin.login');
    }
    public function username()
    {
        $url=URL::previous();
        if($url==url('admin/login')){
            
            return 'username';
            
        }
        else{
            return 'email';
        }
        
    }
    protected function credentials(Request $request)
    {
        $array=$request->only($this->username(), 'password');
        $url=URL::previous();
        if($url==url('admin/login')){
            $array['role']='admin';
        }
        else{
            $array['role']='user';
        }
        //   dd($array);
        return $array;
    }
    public function logout(Request $request)
    {
        $role=Auth::user()->role;
        $this->guard()->logout();

        $request->session()->invalidate();
        if($role=="admin"){return $this->loggedOut($request) ?: redirect('admin/login');}
        elseif($role=="user"){return $this->loggedOut($request) ?: redirect('login');}
        // return $this->loggedOut($request) ?: redirect('/');
    }
}
