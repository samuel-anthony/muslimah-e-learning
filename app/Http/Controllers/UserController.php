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
        date_default_timezone_set('Asia/Jakarta');
        $this->middleware('auth'); //untuk ngecek yang akses menu ini uda login belom
    }
    public function isAdmin(){//untuk ngecek yang login uda bener user bukan admin...
        $user = \Auth::user();//ambil data user yang login dan berusaha akses menu di bawah
        return $user->isAdmin;//kembalikan nilai bahwa user ini admin atau bukan..
    }
    public function index(){
        if(!$this->isAdmin()){//klo bukan admin larikan ke view di bawah
            $currentWeek = (floor((int)date_diff(date_create(\Auth::user()->group->group_strt_dt),date_create())->format('%R%a days'))/7.0)+1;
            // $currentWeek = (floor((int)date_diff(date_create(),date_create(\Auth::user()->group->group_strt_dt))->format("%d"))/7.0)+1;
            $ujians = [];
            if(date("Y-m-d")>=date("Y-m-d",strtotime(\Auth::user()->group->group_strt_dt)))
                $ujians = ujian::where('week','<=',$currentWeek)->get();
            $totalPassed = 0;
            foreach($ujians as $ujian){
                $user_ujian = user_ujian::whereUserId(\Auth::user()->id)->whereUjianId($ujian->id)->whereIsFinished(1)->first();
                $total_correct_answer = 0;
                foreach($ujian->pertanyaans as $pertanyaan){
                    if(!is_null($user_ujian)){
                        foreach($user_ujian->user_ujian_details as $jawaban){
                            if($pertanyaan->id == $jawaban->pertanyaan_id){
                                if($pertanyaan->jawaban_benar == $jawaban->jawaban){
                                    $total_correct_answer++;
                                    break;
                                }
                            }
                        }
                    }
                }
                $totalPassed = (($total_correct_answer/count($ujian->pertanyaans)*1.00)>0.5) ? ($totalPassed+1): $totalPassed;
            }
            return view('user.dashboard',[
                'ujians'=>$ujians,
                'totalPassed'=>$totalPassed
            ]);
        }
        else//user admin berusaha open url dari user, jangan bole.. redirect kembali ke /admin
            return redirect('admin');
    }
    public function materi(){
        if(!$this->isAdmin()){
            $currentWeek = (floor((int)date_diff(date_create(\Auth::user()->group->group_strt_dt),date_create())->format('%R%a days'))/7.0)+1;
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
    public function hasilUjian(){
        $ujian = ujian::find(request('ujian_id'));
        $user_ujian = user_ujian::whereUserId(\Auth::user()->id)->whereUjianId(request('ujian_id'))->first();
        $total_correct_answer = 0;
        foreach($ujian->pertanyaans as $pertanyaan){
            $pertanyaan->jawaban_user = "No Answer";
            switch($pertanyaan->jawaban_benar){
                case '1':
                    $pertanyaan->jawaban_benar_text = $pertanyaan->jawaban_a;
                    break;
                case '2':
                    $pertanyaan->jawaban_benar_text = $pertanyaan->jawaban_b;
                    break;
                case '3':
                    $pertanyaan->jawaban_benar_text = $pertanyaan->jawaban_c;
                    break;
                case '4':
                    $pertanyaan->jawaban_benar_text = $pertanyaan->jawaban_d;
                    break;
                default:
                    break;
            }
            foreach($user_ujian->user_ujian_details as $jawaban){
                if($pertanyaan->id == $jawaban->pertanyaan_id){
                    switch($jawaban->jawaban){
                        case '1':
                            $pertanyaan->jawaban_user = $pertanyaan->jawaban_a;
                            break;
                        case '2':
                            $pertanyaan->jawaban_user = $pertanyaan->jawaban_b;
                            break;
                        case '3':
                            $pertanyaan->jawaban_user = $pertanyaan->jawaban_c;
                            break;
                        case '4':
                            $pertanyaan->jawaban_user = $pertanyaan->jawaban_d;
                            break;
                        default:
                            break;
                    }
                    if($pertanyaan->jawaban_benar == $jawaban->jawaban){
                        $total_correct_answer++;
                        break;
                    }
                }
            }
        }
        $ujian->score = $total_correct_answer/count($ujian->pertanyaans)*1.00;
        $ujian->grade = $this->getGrade($ujian->score);
        return view('user.hasilujian',['ujian'=>$ujian]);
    }
    public function ujian(){
        if(!$this->isAdmin()){
            $currentWeek = (floor((int)date_diff(date_create(\Auth::user()->group->group_strt_dt),date_create())->format('%R%a days'))/7.0)+1;
            // $currentWeek = (floor((int)date_diff(date_create(),date_create(\Auth::user()->group->group_strt_dt))->format("%d"))/7.0)+1;
            $ujians = ujian::where('week','<=',$currentWeek)->get();
            foreach($ujians as $ujian){
                $ujian->start_date = date("Y-m-d",strtotime(\Auth::user()->group->group_strt_dt." + ".($ujian->week-1)." weeks"));
                $ujian->end_date = date("Y-m-d",strtotime(\Auth::user()->group->group_strt_dt." + ".$ujian->week." weeks"));
                $time_diff = (new Datetime($ujian->start_date))->diff(new DateTime($ujian->end_date));
                $time_diff2 = (new Datetime($ujian->start_date))->diff(new DateTime());
                $waktu_berlalu_semenjak_ujian = $time_diff2->y * 365 + $time_diff2->m*30 + $time_diff->d;
                $ujian->expired = ($time_diff->d < $waktu_berlalu_semenjak_ujian) && $waktu_berlalu_semenjak_ujian > 7 ? true : false;
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
                $ujian->total_questions = count($ujian->pertanyaans);
                if($ujian->expired){
                    if(!is_null($user_ujian)){
                        foreach($user_ujian->user_ujian_details as $detil){
                            foreach($ujian->pertanyaans as $pertanyaan){
                                if($detil->pertanyaan_id == $pertanyaan->id && $detil->jawaban == $pertanyaan->jawaban_benar){
                                    $ujian->total_correct++;
                                    break;
                                }
                            }
                        }
                    }
                    else{
                        $user_ujian = new user_ujian;
                        $user_ujian->ujian_id = $ujian->id;
                        $user_ujian->user_id = \Auth::user()->id;
                    }
                    $user_ujian->is_finished = 1;
                    $user_ujian->save();
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

        if(!$this->isAdmin()){
            return view('user.ubahpassword',["errorMessage"=>session("errorMessage")]);
        }
        else
            return redirect('admin');

    }
    public function postChangepassword(){
        $user = \Auth::user();

        $validator = Validator::make(request()->input(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|different:oldPassword',
        ],[
            'newPassword.different' => 'Old password and new password must be different'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        if (Hash::check(request('oldPassword'), $user->password)) {
           $user->fill([
            'password' => Hash::make(request('newPassword'))
            ])->save();
            return redirect('sendEmailChangePassword/'.$user->id.'/'.request('oldPassword').'/'.request('newPassword'));

        } else {
            return redirect('/user/ubahpassword')->with(["errorMessage"=>'Incorrect Old Password']);
        }
    }
    public function postChangeProfile(){
        //dd(request()->input());
        $validator = Validator::make(request()->input(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.request('id'),
            'phone' => request('phone') != null ? 'min:10|max:12|regex:/(0)[0-9]*$/' : ''
        ],[
            'email.unique' => 'Duplicate Email, please use another email'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = User::find(request('id'));
        $tempEmail = $user->email;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->email = request('email');
        $user->phone = request('phone');
        $user->save();

        return ($tempEmail == $user->email) ? redirect('/user/profile') : redirect('sendEmailChangeEmail/'.$tempEmail.'/'.$user->email);

    }

    public function ujianStart(){
        $ujian = ujian::find(request('ujian_id'));
        $user = \Auth::user();
        $user_ujian = user_ujian::whereUserId($user->id)->whereUjianId($ujian->id)->get();
        $duration = $ujian->exam_duration;//dalam menit
        $duration*=60;//dalam seken
        $flagNew = false;
        if(count($user_ujian)==0){
            $flagNew = true;
            $user_ujian = new user_ujian;
            $user_ujian->ujian_id = $ujian->id;
            $user_ujian->user_id = $user->id;
            $user_ujian->save();
        }
        else{
            $time_diff = (new Datetime())->diff($user_ujian[0]->created_at);
            $duration -= (($time_diff->i*60) + $time_diff->s);
        }
        if($duration>0)
            return view('user.ujiandetail',[
                "user_ujian"=>!$flagNew ? $user_ujian[0] : $user_ujian,
                "user_ujian_detail"=> !$flagNew ? $user_ujian[0]->user_ujian_details : $user_ujian->user_ujian_details,
                "duration"=>$duration,
            ]);
        else{
            return redirect('/user/ujian')->with('alert','exam has been submitted');
        }
    }

    public function saveAnswer(){
        $ujian = ujian::find(request("ujian_id"));
        $user_ujian = user_ujian::whereUserId(auth()->id())->whereUjianId(request("ujian_id"))->first();
        foreach($ujian->pertanyaans as $pertanyaan){
            if(!is_null(request("jawaban".$pertanyaan->id))){
                $user_ujian_detail = DB::table('user_ujian_details')->join('user_ujians','user_ujian_details.user_ujian_id','=','user_ujians.id')->where('user_ujians.user_id',auth()->id())->where('user_ujian_details.pertanyaan_id',$pertanyaan->id)->first();
                if(!is_null($user_ujian_detail)){
                    $user_ujian_detail = user_ujian_detail::wherePertanyaanId($user_ujian_detail->pertanyaan_id)->whereUserUjianId($user_ujian_detail->user_ujian_id)->first();
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
                    $user_ujian_detail = user_ujian_detail::wherePertanyaanId($user_ujian_detail->pertanyaan_id)->whereUserUjianId($user_ujian_detail->user_ujian_id)->first();
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


    public function getGrade($floatNumber){
        if($floatNumber==1){
            return 'Mumtaz';
        }
        else if($floatNumber>=0.8){
            return 'Jayyid Jiddan';
        }
        else if($floatNumber>0.65){
            return 'Jayyid';
        }
        else if($floatNumber>0.5){
            return 'Maqbul';
        }
        else if($floatNumber>0){
            return 'Rasib';
        }
        return 'Ghayyib';

    }
}
