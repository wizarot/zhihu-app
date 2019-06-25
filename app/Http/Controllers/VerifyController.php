<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class VerifyController extends Controller
{
    public function verify($token)
    {
        $user = User::where('confirmation_token',$token)->first();
        if(empty($user)){
            return redirect('/');
        }

        $user->is_active = 1;
        $user->confirmation_token = Str::random(40);
        $user->save();
        Auth::login($user);
        return redirect('home');
    }
}
