<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.dashboard');
    }
    
    public function materi(){
        return view('admin.materi');
    }
    
    public function ujian(){
        return view('admin.ujian');
    }

    public function anggota(){
        return view('admin.anggota');
    }

    public function register()
    {
        $validator = Validator::make(request()->input(), [
            'user_name' => 'required|unique:users|min:8|max:255',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            // 'password' => 'required|min:8',
            // 'password_confirmation' => 'required_with:password|same:password',
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''    
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->user_name = request('user_name');
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->phone = request('phone');
        $user->email = request('email');
        // $user->password = bcrypt(request('password'));
        $user->save();
        return redirect('/admin')->with('alertSuccess','successfully create to add new user');
    
    }
}
