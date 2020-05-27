<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\group;
use App\ujian;
use App\pertanyaan;
use App\materi;
use App\materi_detail;
use App\user_ujian;
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
            return view('admin.materi',[
                'materis' => materi::all()
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }
    
    public function ujian(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.ujian',[
                'ujians' => ujian::all()
            ]);
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

    public function ranking(){
        if($this->isAdmin()){//klo admin larikan ke view di bawah
            $ujians = ujian::all();
            $groups = group::all();
            $user_ujians = user_ujian::all();
            foreach($groups as $group){
                $listUjian = array();
                $dataSiswa = array();
                foreach($ujians as $ujian){
                    $dataSiswa = array();
                    foreach($user_ujians as $user){
                        if($user->ujian_id == $ujian->id && $user->is_finished){
                            $total_correct =0;
                            $total_question =count($ujian->pertanyaans );
                            foreach($user->user_ujian_details as $user_ujian_detail){
                                foreach($ujian->pertanyaans as $pertanyaan){
                                    if($pertanyaan->id == $user_ujian_detail->pertanyaan_id && $pertanyaan->jawaban_benar == $user_ujian_detail->jawaban){
                                        $total_correct++;
                                    }
                                }
                            }
                            $user->name = $user->user->first_name.' '.$user->user->last_name;
                            $user->group = $group->group_name;
                            $user->score = $total_correct/$total_question*100.0;
                            $user->grade = $this->getGrade($total_correct/$total_question*1.0);
                            array_push($dataSiswa,$user);
                        }
                    }
                    $ujian->dataUjian = $dataSiswa;
                    if(date("Y-m-d")>=date("Y-m-d",strtotime($group->group_strt_dt." + ".($ujian->week - 1)." weeks"))){
                        array_push($listUjian,$ujian);
                    }
                    
                }
                $group->ujian = $listUjian;
            }
            return view('admin.ranking',[
                'groups'=>$groups
            ]);
        }
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function anggota(){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.anggota',[
                'users'=>User::whereIsadmin(0)->get(),//variable user yang bukan admin dilempar ke depan
                'groups'=>group::all()
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function editUjian($param){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.pertanyaan',[
                'ujian'=> ujian::find($param),
                'soals'=> pertanyaan::whereUjianId($param)->get(),
                'soalKe' => count(pertanyaan::whereUjianId($param)->get())+1
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function editMateri($param){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.materidetail',[
                'materi'=> materi::find($param)
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }
    
    public function editMateriDetailPage($param1,$param2){
        if($this->isAdmin())//klo admin larikan ke view di bawah
            return view('admin.materidetailedit',[
                'materi'=> materi_detail::find($param2)
            ]);
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }
    
    public function editPertanyaan($param){
        if($this->isAdmin()){//klo admin larikan ke view di bawah
            $pertanyaan = pertanyaan::find($param);
            $soals = pertanyaan::whereUjianId($pertanyaan->ujian_id)->get();//semua soal 
            $soalKe = 1;
            foreach($soals as $soal){ //ini buat cari tau id bangsul ini sebenernya soal(yang mau diedit) keberapa yang diinput oleh user 
                if($soal->id == $pertanyaan->id)
                    break;
                $soalKe++;
            }
            return view('admin.pertanyaan',[
                'ujian'=> ujian::find($pertanyaan->ujian_id),
                'soals'=> $soals,
                'soalKe'=> $soalKe
            ]);
        }
        else//user biasa berusaha open url page admin, jangan bole.. redirect kembali ke /user
            return redirect('user');
    }

    public function register()
    {
        $validator = Validator::make(request()->input(), [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'phone' => request('phone') != null ? 'regex:/(0)[0-9]*$/' : '',
        ],[
            'email.unique' => 'email sudah digunakan mohon pilih email lain',
            'phone.regex' => 'mohon masukkan format nomor telepon yang sesuai'
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $user = new User;
        $user->first_name = request('first_name');
        $user->last_name = request('last_name');
        $user->phone = request('phone');
        $user->email = request('email');
        $user->groupid = request('group_id');
        //ini buat randomize password
        //ini di encrypt angka 1 nya jadi encript string, setiap kali dia panggil method bcrypt hasil nya pasti beda
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
            'group_name.unique' => 'nama grup sudah digunakan, mohon pakai nama grup lain'
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

    public function tambahUjian(){
        $validator = Validator::make(request()->input(), [
            'exam_title' => 'required',
            'week' => 'required',
            'exam_duration' => 'required',  
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        
        $ujian = new ujian;
        $ujian->exam_title  = request('exam_title');
        $ujian->week  = request('week');
        $ujian->exam_duration  = request('exam_duration');
        $ujian->save();

        return redirect('/admin/editUjian/'.$ujian->id);
    }

    public function submitEditUjian(){
        $ujian = ujian::find(request('ujian_id'));
        $ujian->exam_title  = request('exam_title');
        $ujian->week  = request('week');
        $ujian->exam_duration  = request('exam_duration');
        $ujian->save();
        return redirect('/admin/editUjian/'.request('ujian_id'));
    }

    public function submitPertanyaan(){
        $pertanyaan = new pertanyaan;
        $pertanyaan->ujian_id  = request('ujian_id');
        $pertanyaan->soal_ujian  = request('soal_ujian');
        $pertanyaan->jawaban_a  = request('jawaban_a');
        $pertanyaan->jawaban_b  = request('jawaban_b');
        $pertanyaan->jawaban_c  = request('jawaban_c');
        $pertanyaan->jawaban_d  = request('jawaban_d');
        $pertanyaan->jawaban_benar  = request('jawaban_benar');
        $pertanyaan->save();

        return redirect('/admin/editUjian/'.$pertanyaan->ujian_id);
    }

    public function submitEditPertanyaan(){
        $pertanyaan = pertanyaan::find(request('soal_id'));
        $pertanyaan->soal_ujian  = request('soal_ujian');
        $pertanyaan->jawaban_a  = request('jawaban_a');
        $pertanyaan->jawaban_b  = request('jawaban_b');
        $pertanyaan->jawaban_c  = request('jawaban_c');
        $pertanyaan->jawaban_d  = request('jawaban_d');
        $pertanyaan->jawaban_benar  = request('jawaban_benar');
        $pertanyaan->save();

        return redirect('/admin/editUjian/'.$pertanyaan->ujian_id);
    }

    public function deletePertanyaan(){

        $pertanyaan = pertanyaan::find(request('id'));
        $ujian_id = $pertanyaan->ujian_id;
        $pertanyaan->delete();

        return redirect('/admin/editUjian/'.$ujian_id);
    }

    public function deleteUjian(){
        $ujian = ujian::find(request('id'));
        $pertanyaans = pertanyaan::whereUjianId(request('id'))->get();
        foreach($pertanyaans as $pertanyaan){
            $pertanyaan->delete();
        }
        $ujian->delete();
        return redirect('/admin/ujian');
    }

    public function deleteAnggota(){
        $user = User::find(request('id'));
        $user->delete();
        return redirect('/admin/anggota');
    }

    public function tambahMateri(){
        $validator = Validator::make(request()->input(), [
            'week' => 'unique:materis|gt:0',
        ],[
        ]);
        if ($validator->fails()) {
            $validator->validate();
        }
        $materi = new materi;
        $materi->title = request('title');
        $materi->week = request('week');
        $materi->save();

        return redirect('/admin/editMateri/'.$materi->id);
    }

    public function submitMateriDetail(){
        if(request('materi_type')=="biasa"){
            $validator = Validator::make(request()->input(), [
                'paragraph' => 'required',
            ],[
            ]);
        }
        else{
            $validator = Validator::make(request()->file(), [
                'file' => 'required',
            ],[
            ]);
        }
        if ($validator->fails()) {
            $validator->validate();
        }
        $materi_detail = new materi_detail;
        if(request('materi_type')=="file_upload"){
            $path = request()->file('file')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $materi_detail->type = $_FILES['file']['type'];
            $materi_detail->value = $base64;
        }
        else if(request('materi_type')=="biasa"){
            $materi_detail->type = "paragraph";
            $materi_detail->value = request('paragraph');
        }
        $materi_detail->materi_id = request("materi_id");
        $materi_detail->save();
        
        return redirect('/admin/editMateri/'.request("materi_id"));
    }

    public function editMateriDetail(){
        if(request('materi_type')=="biasa"){
            $validator = Validator::make(request()->input(), [
                'paragraph' => 'required',
            ],[
            ]);
        }
        else{
            $validator = Validator::make(request()->file(), [
                'file' => 'required',
            ],[
            ]);
        }
        if ($validator->fails()) {
            $validator->validate();
        }
        $materi_detail = materi_detail::find(request('id'));
        if(request('materi_type')=="file_upload"){
            $path = request()->file('file')->getRealPath();
            $image = file_get_contents($path);
            $base64 = base64_encode($image);
            $materi_detail->type = $_FILES['file']['type'];
            $materi_detail->value = $base64;
        }
        else if(request('materi_type')=="biasa"){
            $materi_detail->type = "paragraph";
            $materi_detail->value = request('paragraph');
        }
        $materi_detail->save();
        
        return redirect('/admin/editMateri/'.$materi_detail->materi_id);
    }

    public function deleteMateriDetail(){
        $materi_detail = materi_detail::find(request("id"));
        $materi_detail->delete();
        
        return redirect('/admin/editMateri/'.request("mstr_id"));
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
