<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); //untuk ngecek yang akses menu ini uda login belom 
    }
    public function isAdmin(){//untuk ngecek yang login uda bener user bukan admin...
        $user = \Auth::user();//ambil data user yang login dan berusaha akses menu di bawah 
        return $user->isAdmin;//kembalikan nilai bahwa user ini admin atau bukan..
    }
    public function index(){
        if(!$this->isAdmin())//klo bukan admin larikan ke view di bawah
            return view('user.dashboard');
        else//user admin berusaha open url dari user, jangan bole.. redirect kembali ke /admin
            return redirect('admin');
    }
    public function profile(){
        if(!$this->isAdmin())
            return view('user.profile');
        else
            return redirect('admin');
    }
    public function changepassword(){
        if(!$this->isAdmin())
            return view('user.ubahpassword');
        else
            return redirect('admin');
    
    }
    public function postChangepassword(){

    }
    public function postChangeProfile(){
        $validator = Validator::make(request()->input(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,id,'.request('id'),
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
    }
}