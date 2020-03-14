<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\group;
use Validator;
use DateTime;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function isAdmin(){//untuk ngecek yang login uda bener admin bukan user...
        $user = \Auth::user();//ambil data user yang login dan berusaha akses menu di bawah 
        return $user->isAdmin;//kembalikan nilai bahwa user ini admin atau bukan..
    }

    public function index(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.dashboard');
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }
    
    public function materi(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.materi');
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }
    
    public function ujian(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.ujian');
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function group(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.group',[
                //'group'=>group::whereDay('group_strt_dt', '>', date('d'))->get()
                'groups'=>group::all()
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function anggota(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.anggota',[
                'users'=>User::whereIsadmin(0)->get()//variable user yang bukan admin dilempar ke depan
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
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

    public function tambahGroup()
    {
        $validator = Validator::make(request()->input(), [
            'group_name' => 'required|unique:groups',
            'group_strt_dt' => 'required',   
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $group = new group;
        $group->group_name = request('group_name');
        $group->group_strt_dt = DateTime::createFromFormat('Y-m-d',request('group_strt_dt'));
        $group->save();
        return redirect('admin/group');
    }
}
