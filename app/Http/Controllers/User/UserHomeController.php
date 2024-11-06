<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use App\Models\Transitions;
use App\Models\PostCredits;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\ClientReviews;
use App\Models\PortfolioImages;
class UserHomeController extends Controller
{
    public function ProfessionalIndexView()
    {
        $email = session('UserAuth')->email;
        $user = User::where('email', $email)->first();



    // Calculate profile completion score
    $totalFields = 12; // Total number of fields to consider for profile completion
    $filledFields = 0;

    // Increment the count of filled fields for each non-null user field
    if ($user->name) $filledFields++;
    if ($user->about) $filledFields++;
    if ($user->profile_image) $filledFields++;
    if ($user->company_name) $filledFields++;
    if ($user->phone_number) $filledFields++;
    if ($user->website_link) $filledFields++;
    if ($user->company_size) $filledFields++;
    if ($user->email_verified) $filledFields++;
    if ($user->postcode) $filledFields++;

    // Calculate the profile completion percentage
    $profileCompletion = ($filledFields / $totalFields) * 100;

        $allLeads = Posts::where('status' , '1')->where('permanently_disabled', '0')->get();
        
        // Group leads by service_sub_category
        
        return view('Users.Professional.index', compact('user', 'allLeads', 'profileCompletion'));
    }

    // public function ProfessionalLeadView()
    // {
    //     $USERemail = session('UserAuth')->email;
    //     $LOGINEDuser = User::where('email', $USERemail)->get();
    //     $user_auth = User::where('email', $USERemail)->get();
        
    //     // Fetch all leads
    //     $allLeads = Posts::all();
        
        
    
    //     return view('Users.Professional.leads', compact('allLeads', 'LOGINEDuser' ,'user_auth'));
    // }
    

    public function ProfessionalLeadView()
    {
        $USERemail = session('UserAuth')->email;
        $LOGINEDuser = User::where('email', $USERemail)->get();
        $user_auth = User::where('email', $USERemail)->get();
        
     
        foreach($user_auth as $user_auths){
            if($user_auths->customer_serve == 'postcode') {
                $user_postcode = $user_auths->postcode;
            // Extract only the first two letters from the postcode
            preg_match('/[a-zA-Z0-9]{2}/', $user_postcode, $matches);
            $firstTwoLetters = $matches[0]; // Get the matched two letters

            // Fetch all leads where postcode starts with the extracted two letters
            $allLeads = Posts::where('status', '1')
                ->where('permanently_disabled', '0')
                ->where('postcode', 'LIKE', $firstTwoLetters . '%')
                ->get();
            }
            else
            {
                // // Fetch all leads
                $allLeads = Posts::where('status' , '1')->where('permanently_disabled', '0')->get();
            }
        }
     
        $postCredits = []; // Initialize an empty array to store all post credits
        
        foreach ($allLeads as $lead) {
            // Fetch post credits where service_sub_category, service_sub_category_parent, and credits match lead values
            $leadPostCredits = PostCredits::where('service_sub_category', $lead->service_sub_category)
                ->where('service_sub_category_parent', $lead->service_sub_category_parent)
                ->where('credits', $lead->credits)
                ->get();
            
            // Merge the fetched post credits with the array
            $postCredits = array_merge($postCredits, $leadPostCredits->toArray());
        }
    
        return view('Users.Professional.leads', compact('allLeads', 'LOGINEDuser', 'user_auth', 'postCredits'));
    }
    


    public function ProfessionalSettingsView($id)
    {
        $id = session('UserAuth')->id;
         $email = session('UserAuth')->email;
        $user_images = PortfolioImages::where('user_email', $email)->get();
        $users = User::where('id', $id)->get();
        $service_categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $sub_categories = ServiceSubCategory::where('service_sub_category_status', 'Active')->get();
        return view('Users.Professional.Profile.settings', compact('sub_categories','users', 'service_categories','user_images'));
    }


    public function ProfessionalPaymentDetails()
    {
        $email = session('UserAuth')->email;
        $id = session('UserAuth')->id;
        $details = Transitions::where('LoginedUserEmail', $email)->get();
        $users = User::where('id', $id)->get();
        return view('Users.Professional.payment-details', compact('details', 'users'));
    }


    public function ProfessionalPublicProfileView($email)
    {
        $user = User::where('email', $email)->first();
        $reviews = ClientReviews::where('email', $email)->get();
         $user_images = PortfolioImages::where('user_email', $email)->get();
        $reviews_count = $reviews->count();
    
        // Calculate the average rating
        $average_rating = $reviews->avg('rating');
    
        // Calculate the distribution of ratings
        $rating_distribution = [
            '5' => $reviews->where('rating', 5)->count(),
            '4' => $reviews->where('rating', 4)->count(),
            '3' => $reviews->where('rating', 3)->count(),
            '2' => $reviews->where('rating', 2)->count(),
            '1' => $reviews->where('rating', 1)->count(),
        ];
    
        return view('Users.Professional.Profile.public-profile', compact('user', 'reviews', 'reviews_count', 'average_rating', 'rating_distribution','user_images'));
    }
    

      


// Get Service DashbOard

    public function GetServiceIndexView()
    {
        $email = session('UserAuth')->email;
        $users = User::where('email', $email)->get();
        $leads = Posts::where('email', $email)->where('status', '1')->where('permanently_disabled', '0')->with('questionAnswers')->get(); // Ensure leads are loaded with their related questionAnswers

        return view('Users.GetService.index', compact('leads', 'users'));
    }

    public function GetServiceCompelteRequestsView()
    {
        $email = session('UserAuth')->email;
        $users = User::where('email', $email)->get();
        $leads = Posts::where('email', $email)->where('status', '0')->where('permanently_disabled', '0')->with('questionAnswers')->get(); // Ensure leads are loaded with their related questionAnswers

        return view('Users.GetService.completed-requests', compact('leads', 'users'));
    }




    public function GetServiceSettingView($id)
    {
        $id = session('UserAuth')->id;
        $users = User::where('id', $id)->get();

        return view('Users.GetService.setting', compact('users'));
    }
   
    
    
    
}
