<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    // Login Form 
    public function AdminLoginForm()
    {
        return view('Admin.Auth.login');
    }


    public function admin_authenticate(Request $req)
{

    $email = $req->input('email');
    $password = $req->input('password');
   
    $Admin = DB::table('admins')->where('email', $email)->first();
    // dd($user);
    if ($Admin) {
        // Verify password
        if (password_verify($req->input('password'), $Admin->password)) {
          // Store client information in session
            session(['AdminAuth' => $Admin]);

            // Redirect based on user role
            
                return redirect('/admin-dashboard');
            
        } else {
            // Password doesn't match
            return redirect('/weconnectt-login')->with('error', 'Wrong password.');
        }
    } else {
        // Email does not exist
        return redirect('/weconnectt-login')->with('error', 'Email does not exist.');
    }
}

    


    public function AdminLogout()
    {
        Session::forget('AdminAuth');
        return redirect('/weconnectt-login')->with('success', 'Logout successful.');
    }

}
