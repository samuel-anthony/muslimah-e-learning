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
            'dear'=>'Yth, Bp/Ibu '.$user->first_name.' '.$user->last_name,
            'row1' => 'Berikut adalah password yang bisa digunakan untuk login',
			'row2' => 'Password : '.$unEncriptedPassword,
			'row3' => '',
			'row4' => 'Terima Kasih',
            //'image' => $project->media
        ];

        \Mail::to($user->email)->send(new SendMail($details));
        return redirect('/admin')->with('alertSuccess','successfully create to add new user');
    }
}