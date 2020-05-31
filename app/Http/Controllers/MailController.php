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
			'row3' => '',
			'row4' => 'Thank You',
            //'image' => $project->media
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return redirect('/admin/anggota')->with('alertSuccess','successfully create to add new user');
    }
}