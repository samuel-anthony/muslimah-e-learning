<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ujian;
use App\user_ujian;
use App\user_ujian_detail;
use App\materi;
use Validator;
use DateTime;
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
    public function materi(){
        if(!$this->isAdmin()){
            $currentWeek = (floor((int)date_diff(date_create(),date_create(\Auth::user()->group->group_strt_dt))->format("%d"))/7.0)+1;
            return view('user.materi',[
                "materis"=>materi::where('week','<=',$currentWeek)->get()
            ]);
        }
        else
            return redirect('admin');
    }
    public function openMateri($param){
        if(!$this->isAdmin())
            return view('user.openmateri',[
                "materi"=>materi::find($param)
            ]);
        else
            return redirect('admin');
    }
    public function ujian(){
        if(!$this->isAdmin()){
            $currentWeek = (floor((int)date_diff(date_create(),date_create(\Auth::user()->group->group_strt_dt))->format("%d"))/7.0)+1;
            $ujians = ujian::where('week','<=',$currentWeek)->get();
            foreach($ujians as $ujian){
                $ujian->start_date = date("Y-m-d",strtotime(\Auth::user()->group->group_strt_dt." + ".($ujian->week-1)." weeks"));
                $ujian->end_date = date("Y-m-d",strtotime(\Auth::user()->group->group_strt_dt." + ".$ujian->week." weeks"));
                $time_diff = (new Datetime($ujian->start_date))->diff(new DateTime($ujian->end_date));
                $time_diff2 = (new Datetime($ujian->start_date))->diff(new DateTime());
                $ujian->expired = ($time_diff->d < $time_diff2->d) && $time_diff2->d > 7 ? true : false;
                $user_ujian = user_ujian::whereUserId(\Auth::user()->id)->whereUjianId($ujian->id)->first();
                if(!is_null($user_ujian)){
                    // $time_diff = (new Datetime())->diff($user_ujian->created_at);
                    // $duration = $ujian->exam_duration - $time_diff->i;
                    $time_diff = round(abs(strtotime("now")-strtotime($user_ujian->created_at)) / 60,2);
                    $duration = $ujian->exam_duration - $time_diff;
                    if($duration < 0 || $user_ujian->is_finished){
                        $ujian->expired = true;
                    }
                    else{
                        $ujian->expired = false;
                    }
                }
                $ujian->total_correct = 0;
                if($ujian->expired){
                    foreach($user_ujian->user_ujian_details as $detil){
                        foreach($ujian->pertanyaans as $pertanyaan){
                            if($detil->pertanyaan_id == $pertanyaan->id){
                                $ujian->total_correct++;
                                break;
                            }
                        }
                    }
                }
                
            }
            return view('user.ujian',[
                "ujians"=> $ujians
            ]);
        }
        else
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
        $user = \Auth::user();

        $validator = Validator::make(request()->input(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|different:oldPassword',
        ]);
        
        if ($validator->fails()) {
            $validator->validate();
        }
        if (Hash::check(request('oldPassword'), $user->password)) { 
           $user->fill([
            'password' => Hash::make(request('newpassword'))
            ])->save();
        
            return redirect('user');
        
        } else {
            return redirect('/user');
        }
    }
    public function postChangeProfile(){
        //dd(request()->input());
        $validator = Validator::make(request()->input(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,id,'.request('id'),
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : ''
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = User::find(request('id'));
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();
        return redirect('/user');
    }

    public function ujianStart(){
        $ujian_id = request('ujian_id');
        $user = \Auth::user(); 
        $user_ujian = user_ujian::whereUserId($user->id)->whereUjianId($ujian_id)->get();
        $duration = 30;
        if(count($user_ujian)==0){
            $user_ujian = new user_ujian;
            $user_ujian->ujian_id = $ujian_id;
            $user_ujian->user_id = $user->id;
            $user_ujian->save();
        }
        else{
            $time_diff = (new Datetime())->diff($user_ujian[0]->created_at);
            $duration -= $time_diff->i; 
        }
        if($duration>0)
            return view('user.ujiandetail',[
                "user_ujian"=>$user_ujian[0],
                "user_ujian_detail"=> !is_null($user_ujian[0]->user_ujian_details) ? $user_ujian[0]->user_ujian_details : null,
                "duration"=>$duration,
            ]);
        else{
            return redirect('/user/ujian')->with('alert','data successfully approved');
        }
    }

    public function saveAnswer(){
        $ujian = ujian::find(request("ujian_id"));
        $user_ujian = user_ujian::whereUserId(auth()->id())->whereUjianId(request("ujian_id"))->first();
        foreach($ujian->pertanyaans as $pertanyaan){
            if(!is_null(request("jawaban".$pertanyaan->id))){
                $user_ujian_detail = DB::table('user_ujian_details')->join('user_ujians','user_ujian_details.user_ujian_id','=','user_ujians.id')->where('user_ujians.user_id',auth()->id())->where('user_ujian_details.pertanyaan_id',$pertanyaan->id)->first();
                if(!is_null($user_ujian_detail)){
                    $user_ujian_detail = user_ujian_detail::find($user_ujian_detail->id);
                    $user_ujian_detail->jawaban = request("jawaban".$pertanyaan->id);
                    $user_ujian_detail->save();
                }else{
                    $user_ujian_detail = new user_ujian_detail;
                    $user_ujian_detail->user_ujian_id = $user_ujian->id;
                    $user_ujian_detail->pertanyaan_id = $pertanyaan->id;
                    $user_ujian_detail->jawaban = request("jawaban".$pertanyaan->id);
                    $user_ujian_detail->save();
                }
            }
        }
        return redirect("/user/ujian");
    }
    public function submitAnswer(){
        
        $ujian = ujian::find(request("ujian_id"));
        $user_ujian = user_ujian::whereUserId(auth()->id())->whereUjianId(request("ujian_id"))->first();
        foreach($ujian->pertanyaans as $pertanyaan){
            if(!is_null(request("jawaban".$pertanyaan->id))){
                $user_ujian_detail = DB::table('user_ujian_details')->join('user_ujians','user_ujian_details.user_ujian_id','=','user_ujians.id')->where('user_ujians.user_id',auth()->id())->where('user_ujian_details.pertanyaan_id',$pertanyaan->id)->first();
                if(!is_null($user_ujian_detail)){
                    $user_ujian_detail = user_ujian_detail::find($user_ujian_detail->id);
                    $user_ujian_detail->jawaban = request("jawaban".$pertanyaan->id);
                    $user_ujian_detail->save();
                }else{
                    $user_ujian_detail = new user_ujian_detail;
                    $user_ujian_detail->user_ujian_id = $user_ujian->id;
                    $user_ujian_detail->pertanyaan_id = $pertanyaan->id;
                    $user_ujian_detail->jawaban = request("jawaban".$pertanyaan->id);
                    $user_ujian_detail->save();
                }
            }
            else{
                $user_ujian_detail = new user_ujian_detail;
                $user_ujian_detail->user_ujian_id = $user_ujian->id;
                $user_ujian_detail->pertanyaan_id = $pertanyaan->id;
                $user_ujian_detail->jawaban = 0;
                $user_ujian_detail->save();
            }
        }
        $user_ujian->is_finished = true;
        $user_ujian->save();
        return redirect("/user/ujian");
    }
}
