<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;//DATA DATABASE
use Illuminate\Support\Facades\Auth;//INI UNTUK KEPENTINGAN LOGIN
class CustomLoginController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function index(){
        $user = \Auth::user();//ngecek ad yang user login apa engga
        if(!is_null($user)){
            if($user->isAdmin == 0)//user biasa bukan admin
                return redirect('/user');
            else
                return redirect('/admin');
        }
        return view('auth.login');
    }
    
    public function contactus(){
        return view('admin.hubungi');
    }
    public function login(){
        $user = User::where('email',request('email'))->get();
        if(count($user)>0){
            if(Auth::attempt([
                'email'=>request('email'),
                'password'=>request('password')
            ])){
                if($user[0]->isAdmin == 0)//user biasa bukan admin
                    return redirect('/user');
                else
                    return redirect('/admin');
            }
            else{
                return view('auth.loginerror',[
                    'user_name' => request('email'),
                    'error_message' => 'The Credential Doesn\'t Match'
                ]);
            }
        }
        else{
            return view('auth.loginerror',[
                'user_name' => request('email'),
                'error_message' => 'The Credential Doesn\'t Match'
            ]);
        }
    }
    public function test(){
        return view('test');
    }
}
