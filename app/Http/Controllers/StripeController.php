<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Stripe;

use App\Models\User;
use App\Models\UserCreditDetail;


class StripeController extends Controller
{
    public function stripeformView($email)
    {
        $id = session('UserAuth')->id;
        $users = User::where('id', $id)->get();
        $email = session('UserAuth')->email;        
        return view('Users.Professional.stripe-payment', compact('email', 'users'));
    }


    public function stripePost(Request $request)
    {
        // Validate the incoming request
      
    
        // Retrieve user email from session
        $email = session('UserAuth')->email;
        $amount = $request->input('amount');
        $user = User::where('email', $email)->first();
    
        if ($user) {
            // Set the Stripe API key
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
          
            try {
                // Create a charge
                Stripe\Charge::create([
                    "amount" => $amount * 100, // Stripe expects amount in cents
                    "currency" => "gbp",
                    "source" => $request->input('stripeToken'),
                    "description" => "Payment From Weconnectt"
                ]);
    
                // Update user's balance
                $user->balance += 60; // Assuming a fixed credit addition, adjust if necessary
                $user->save();
    
                // Store credit details
                $userCreditDetail = new UserCreditDetail();
                $userCreditDetail->user_id = $user->id;
                $userCreditDetail->payment_date = Carbon::now();
                $userCreditDetail->payment_amount = $amount;
                $userCreditDetail->currency = 'GBP';
                $userCreditDetail->credits_purchased = 60; // Assuming 60 credits are purchased
                $userCreditDetail->save();
    
                // Redirect with success message
                return redirect('/professional-dashboard')
                    ->with('success', 'Payment successful!');
            } catch (\Exception $e) {
                // Handle exceptions (e.g., Stripe errors)
                return redirect('/professional-dashboard')
                    ->with('error', 'Payment failed! ' . $e->getMessage());
            }
        } else {
            // Redirect if user is not found
            return redirect('/professional-dashboard')->with('error', 'User not found!');
        }
    }

    public function UserCreditsDetailsTable()
    {
        $email = session('UserAuth')->email;
       
        $user = User::where('email', $email)->first();
        $user_creditDetails = UserCreditDetail::where('user_id' , $user->id)->get();
        return view('Users.Professional.credits-details' ,compact('user' , 'user_creditDetails'));
    }
    
}
