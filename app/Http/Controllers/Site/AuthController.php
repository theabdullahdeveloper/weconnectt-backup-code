<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\OurClients;
class AuthController extends Controller
{
    public function LoginForm()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.Auth.login', compact('categories'));
    }

    public function ForgotPasswordView()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.Auth.forgot-password', compact('categories'));
    }

    
    

    public function professionalAccountStartView()
    {
        $serviceCategory = ServiceCategory::where('service_category_status', 'Active')->get();
        $categories = ServiceSubCategory::where('service_sub_category_status', 'Active')->get();
        $OurClients = OurClients::all();
        return view('Site.Auth.professional-sign-in-start', compact('serviceCategory','OurClients','categories'));
    }
    

    public function professionalAccountStartStore(Request $request)
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $category = $request->input('category');
        Session::put('selected_category', $category); 
        return redirect()->route('professional.account.register.view', ['category' => $category ,'categories' => $categories]);
    }


    public function ProfessionalAccountRegisterView($category)
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $selectedCategory = $category;
        return view('Site.Auth.professional-register', compact('selectedCategory', 'categories'));
    }


    public function StoreProfessionalAccountUser(Request $request)
    {
       $existingUser = User::where('email', $request->input('email'))->first();

if ($existingUser) {
    // Redirect back with error message if email already exists
    return redirect('/login')->with('error', 'Email already exists.');
}
        $user = new User();
        $user->service = $request->input('service');
        $user->email_verified = $request->input('email_verified');
        $user->role = $request->input('role');
        $user->customer_serve = $request->input('customer_serve');
        $user->miles = $request->input('miles');
        $user->postcode = $request->input('postcode');
        $user->name = $request->input('name');
        $user->company_name = $request->input('company_name');
       
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->has_website = $request->input('has_website');
        $user->website_link = $request->input('website_link');
        $user->company_size = $request->input('company_size');

        // If company size is applicable, set sales team and social media fields
        if (in_array($request->input('company_size'), ['11–50', '51-200', '200+'])) {
            $user->hasSalesTeam = $request->input('hasSalesTeam');
            $user->usesSocialMedia = $request->input('usesSocialMedia');
        }

        // Hash the password before saving
        $user->password = bcrypt($request->input('password'));

        // Save the user
        $user->save();
        Mail::send('Site.Emails.greetings', ['name' => $request->input('name')], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Greetings');
        });
        return redirect('/login')->with('success', 'Account created successfully!');
    }


    public function GetServiceRegisterView($email)
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $email = $email;
        return view('Site.Auth.get-service-register' , compact('email', 'categories'));
    }




    public function GetServiceUserStore(Request $request)
    {
        $existingUser = User::where('email', $request->input('email'))->first();
    
        if ($existingUser) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email already exists.',
            ]);
        }
    
        $user = new User();
        $user->email_verified = $request->input('email_verified');
        $user->role = $request->input('role');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone_number = $request->input('phone_number');
        $user->password = bcrypt($request->input('password'));
        $user->save();
    
        // Send mail
        Mail::send('Site.Emails.greetings', ['name' => $request->input('name')], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Greetings');
        });
    
        return response()->json([
            'status' => 'success',
            'message' => 'Your account has been created.'
        ]);
    }
    
    



    //forget
    
    
    public function ForgotPasswordSubmit(Request $request)
    {

        $existingUser = User::where('email', $request->input('email'))->first();
        // dd($request->input('email'));
        if (!$existingUser) {
            return redirect()->back()->with('error' , 'Email not exists.');
        }
            
            $token = Str::random(64);
            
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
                
             ]);
             
             
             
        Mail::send('Site.Emails.reset-password', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
            
            
            
        });
        
        
          return redirect('/login')->with('success', 'We Have E-mailed Your Password Reset Link!');
        
    }
    
    
    
    
    
    public function showResetPasswordForm($token){
          
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.Auth.set-new-password', ['token'=> $token ,'categories'=> $categories]);
       
    }


  
    public function SubmitResetPasswordForm(Request $request)
    {
        $token = DB::table('password_reset_tokens')->where('token', $request->input('token'))->get();

        // $useremail = null;
        foreach ($token as $key) {
            $useremail = $key->email;
        }
    
        if (!$useremail) {
            return back()->withInput()->with('error', 'Reset link has expired!');
        }
    
        $password = $request->password;
    
        DB::table('users')
            ->where('email', $useremail)
            ->update(['password' => bcrypt($password)]);
    
        DB::table('password_reset_tokens')->where('token', $request->input('token'))->delete();
    
        return redirect('/login')->with('success', 'Password has been reset successfully!');

    }
    public function SendVerifyEmail(Request $request)
    {
        $existingUser = User::where('email', $request->input('email'))->first();
        if (!$existingUser) {
            return redirect()->back()->with('error' , 'Email not exists.');
        }
            
            $token = Str::random(64);
            $otp = '';
            for ($i = 0; $i < 8; $i++) {
                $otp .= mt_rand(0, 9);
            }
            
            
            
            $emailExists = DB::table('email_o_t_p_tokens')
            ->where('email', $request->email)
            ->exists();
        
        if ($emailExists) {
            return redirect()->back()->with('existserror' ,  'Please wait, an OTP has already been sent to this <b>' .$request->email .' </b> email. If you have not received it, please try resending.');
        } else {
            DB::table('email_o_t_p_tokens')->insert([
                'email' => $request->email,
                'otp' => $otp,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }
             
             
             
             Mail::send('Site.Emails.verify-account', ['token' => $token, 'otp' => $otp], function($message) use($request){
            $message->to($request->email);
            $message->subject('Verify Your Email');
            
        });
        
        Session::forget('UserAuth');
          return redirect('/login')->with('success', 'We have sent the email containing the link to verify your email request.');
    }

    public function ResendVerifyEmail(Request $request)
    {
        $existingUser = User::where('email', $request->input('email'))->first();
        if (!$existingUser) {
            return redirect()->back()->with('error' , 'Email not exists.');
        }
            
            $token = Str::random(64);
            $otp = '';
            for ($i = 0; $i < 8; $i++) {
                $otp .= mt_rand(0, 9);
            }
            
            
            
            $emailExists = DB::table('email_o_t_p_tokens')
            ->where('email', $request->email)
            ->exists();
        
            if ($emailExists) {
                DB::table('email_o_t_p_tokens')
                    ->where('email', $request->email)
                    ->delete();
            }
            DB::table('email_o_t_p_tokens')->insert([
                'email' => $request->email,
                'otp' => $otp,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        
             
             
             
             Mail::send('Site.Emails.verify-account', ['token' => $token, 'otp' => $otp], function($message) use($request){
            $message->to($request->email);
            $message->subject('Verify Your Email');
            
        });
        
        Session::forget('UserAuth');
          return redirect('/login')->with('success', 'We have sent the email containing the link to verify your email request.');
    }

    public function ShowVerifyEmailForm($token){
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
          
        return view('Site.Auth.otp-confrim', ['token'=> $token, 'categories' => $categories]);
       
    }

    public function CheckOtp(Request $request)
    {
        $token = $request->input('token');
        $otpToken = DB::table('email_o_t_p_tokens')->where('token', $token)->first();
    
        if (!$otpToken) {
            return redirect()->back()->with('error', 'Link has expired or is invalid.');
        }
    
        $useremail = $otpToken->email;
        $userotp = $otpToken->otp;
    
        if ($request->input('otp') == $userotp) {
            // Update the user's table to mark email as verified
            User::where('email', $useremail)->update(['email_verified' => '1']);
    
            // Delete the OTP token from the table
            DB::table('email_o_t_p_tokens')->where('token', $token)->delete();
    
            return redirect('/login')->with('success', 'Your email has been verified successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP.');
        }
    
    }

   
}

    

   