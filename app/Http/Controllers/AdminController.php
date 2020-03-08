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
        return view('admin.anggota',[
            'users'=>User::whereIsadmin(0)->get()
        ]);
    }

    public function register()
    {
        $validator = Validator::make(request()->input(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''    
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->phone = request('phone');
        $user->email = request('email');
        //ini buat randomize password
        //ini di encrypt angka 1 nya jadi encript stirng, setiap kali dia panggil method bcrypt hasil nya pasti beda
        //nti yang jadi passwordnya user adalah 7-10 string awal dari encryptan angka 1
        $passwordUser = substr(bcrypt('1'),0,rand(8,11));
        $user->password = bcrypt($passwordUser);
        $user->save();
        return redirect('sendEmailRegister/'.$user->id.'/'.$passwordUser);
    }
}
