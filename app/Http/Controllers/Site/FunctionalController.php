<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\PostCredits;
use App\Models\User;
use App\Models\QuestionAnswerByUserForPost;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FunctionalController extends Controller
{
    
//     public function storePost(Request $request)
// {
//     $email = $request->email;
//     $service_sub_category = $request->service_sub_category;
//     $postcode = $request->postcode;
//     $post_time = $request->post_time;
    

//     $existingUser = User::where('email', $email)->first();

//     if (!$existingUser) {
//         Session::put('email', $email);
//         return redirect()->route('getservice.account.register.view', ['email' => $email]);
//     }
 
//     foreach ($request->all() as $key => $value) {
//         if (strpos($key, 'answer_') === 0) {
//             $question = substr($key, strlen('answer_'));
//             $answer = $value;

//             // Store the data in the database
//             Posts::create([
//                 'service_sub_category' => $service_sub_category,
//                 'post_time' => $post_time,
//                 'postcode' => $postcode,
//                 'email' => $email,
//                 'question' => $question,
//                 'answer' => $answer,
//             ]);
//         }
//     }

//     // Redirect the user after successful submission
//     return redirect('/login')->with('success', 'The request has been submitted. You can login to review it.');
// }



//     public function storePost(Request $request)
// {
//     $email = $request->email;
//     $service_sub_category = $request->service_sub_category;
//     $service_sub_category_parent = $request->service_sub_category_parent;
//     $postcode = $request->postcode;
//     $post_time = $request->post_time;
//     $user_answer_about_credit = $request->user_answer_about_credit;
    

//     $existingUser = User::where('email', $email)->first();

//     if (!$existingUser) {
//         Session::put('email', $email);
//         return redirect()->route('getservice.account.register.view', ['email' => $email]);
//     }
 
//     foreach ($request->all() as $key => $value) {
//         if (strpos($key, 'answer_') === 0) {
//             $question = substr($key, strlen('answer_'));
//             $answer = $value;
//             $credits = PostCredits::where('credit_answer', $user_answer_about_credit)->where('service_sub_category', $service_sub_category)->where('service_sub_category_parent', $service_sub_category_parent)->value('credits');
//             // Store the data in the database
//             Posts::create([
//                 'service_sub_category' => $service_sub_category,
//                 'service_sub_category_parent' => $service_sub_category_parent,
//                 'credits' => $credits,
//                 'post_time' => $post_time,
//                 'postcode' => $postcode,
//                 'email' => $email,
//                 'question' => $question,
//                 'answer' => $answer,
//             ]);
        
//     }
//     }

//     // Redirect the user after successful submission
//     return redirect('/login')->with('success', 'The request has been submitted. You can login to review it.');
// }





// app/Http/Controllers/YourController.php

public function storePost(Request $request)
{
    $email = $request->email;
    $city = $request->city;
    $service_sub_category = $request->service_sub_category;
    $service_sub_category_parent = $request->service_sub_category_parent;
    $postcode = $request->postcode;
    $post_time = $request->post_time;
    $user_answer_about_credit = $request->user_answer_about_credit;


    $credits = PostCredits::where('credit_answer', $user_answer_about_credit)
        ->where('service_sub_category', $service_sub_category)
        ->where('service_sub_category_parent', $service_sub_category_parent)
        ->value('credits');

    // Create the post
    $post = Posts::create([
        'service_sub_category' => $service_sub_category,
        'service_sub_category_parent' => $service_sub_category_parent,
        'credits' => $credits,
        'post_time' => $post_time,
        'postcode' => $postcode,
        'city' => $city,
        'email' => $email,
    ]);

    // Store questions and answers in the new table
    foreach ($request->all() as $key => $value) {
        if (strpos($key, 'answer_') === 0) {
            $question = substr($key, strlen('answer_'));
            $answer = $value;
            QuestionAnswerByUserForPost::create([
                'post_id' => $post->id,
                'question' => $question,
                'answer' => $answer,
            ]);
        }
    }

    // Redirect the user after successful submission
    return redirect('/login')->with('success', 'The request has been submitted. You can login to review it.');
}


public function checkEmail(Request $request)
{
    $email = $request->email;
    // dd($email);
    $existingUser = User::where('email', $email)->exists();

    return response()->json(['exists' => $existingUser]);
}


public function sendOtp(Request $request)
{
    $email = $request->input('email');
    $otp = rand(100000, 999999);

    // Store OTP in session or temporarily in database
    session(['otp' => $otp]);

    // Send OTP via email
    Mail::send('Site.Emails.otp', ['otp' => $otp], function($message) use ($email) {
        $message->to($email);
        $message->subject('Your OTP Code');
    });

    return response()->json(['status' => 'success', 'message' => 'OTP sent successfully']);
}

public function verifyOtp(Request $request)
{
    $otp = $request->input('otp');
    $storedOtp = session('otp');

    if ($otp == $storedOtp) {
        // OTP is correct
        return response()->json(['status' => 'success']);
    } else {
        // OTP is incorrect
        return response()->json(['status' => 'error', 'message' => 'Invalid OTP']);
    }
}





}

