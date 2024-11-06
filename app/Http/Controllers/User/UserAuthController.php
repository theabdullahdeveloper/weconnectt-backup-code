<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    
    public function UserAuthenticateSubmit(Request $req)
{

    $email = $req->input('email');
    $password = $req->input('password');
//    dd($email);
    $user = DB::table('users')->where('email', $email)->first();
    // dd($user);
    if ($user) {
        // Verify password
        if (password_verify($req->input('password'), $user->password)) {
          // Store client information in session
            session(['UserAuth' => $user]);

            
            if ($user->role === 'Professional') {
                return redirect('/professional-dashboard');
            } elseif ($user->role === 'GetService') {
                return redirect('/get/service/dashboard');
            }
            
        } else {
            // Password doesn't match
            return redirect('/login')->with('error', 'Wrong password.');
        }
    } else {
        // Email does not exist
        return redirect('/login')->with('error', 'Email does not exist.');
    }
}

    


    public function UserLogout()
    {
        Session::forget('UserAuth');
        return redirect('/login')->with('success', 'Logout successful.');
    }
}
