<?php

namespace App\Http\Controllers;

use \App\Mail\SendMail;
use Illuminate\Http\Request;
use App\User;
class MailController extends Controller
{
    public function mailsendregister($userID,$unEncriptedPassword){
        $user = User::find($userID);
        $details = [
            'dear'=>'Assalamu\'alaikum ummu/ukhti '.$user->first_name.' '.$user->last_name,
            'row1' => 'Here are the passwords that can be used to login to your account in Sahabat Muslimah',
			'row2' => 'Password : '.$unEncriptedPassword,
			'row3' => 'You can start accessing learning material and exam at '.$user->group->group_strt_dt,
			'row4' => '',
			'row5' => '',
            //'image' => $project->media
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return redirect('/admin/anggota')->with('alertSuccess','successfully create to add new user');
    }

    public function mailsendChangeEmail($old,$new){
        $user = User::whereEmail($new)->first();
        $details = [
            'dear'=>'Assalamu\'alaikum ummu/ukhti '.$user->first_name.' '.$user->last_name,
            'row1' => 'You have successfully change your email',
			'row2' => 'From Old Email : '.$old,
			'row3' => 'To New Email : '.$new,
			'row4' => '',
			'row5' => 'Please use the new email for the next login.',
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return redirect('/admin/anggota')->with('alertSuccess','successfully create to add new user');
    }


    public function mailsendChangePassword($userID,$old,$new){
        $user = User::find($userID);
        $details = [
            'dear'=>'Assalamu\'alaikum ummu/ukhti '.$user->first_name.' '.$user->last_name,
            'row1' => 'You have successfully change your password',
			'row2' => 'From Old Password : '.$old,
			'row3' => 'To New Password :'.$new,
			'row4' => '',
			'row5' => 'Please use the new password for the next login.',
            //'image' => $project->media
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return redirect('/admin/anggota')->with('alertSuccess','successfully create to add new user');
    }



}
