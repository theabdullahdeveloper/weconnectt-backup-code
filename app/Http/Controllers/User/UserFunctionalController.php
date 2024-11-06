<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\PortfolioImages;



use App\Models\User;
use App\Models\Posts;
use App\Models\Transitions;
use App\Models\ClientReviews;
class UserFunctionalController extends Controller
{

    // ------------- Professional ------------------ //
    public function UpdateProfessionalAccountUser(Request $request)
    {
        // Find the user by email
        $user = User::where('id', $request->input('id'))->first();
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update user fields
        $user->name = $request->input('name');
        $user->about = $request->input('about');
        $user->website_link = $request->input('website_link');
        $user->phone_number = $request->input('phone_number');
        $user->company_size = $request->input('company_size');
        $user->company_name = $request->input('company_name');

        // If company size is applicable, update sales team and social media fields
        if (in_array($request->input('company_size'), ['11–50', '51-200', '200+'])) {
            $user->hasSalesTeam = $request->input('hasSalesTeam');
            $user->usesSocialMedia = $request->input('usesSocialMedia');
        } else {
            // If company size is not applicable, reset sales team and social media fields
            $user->hasSalesTeam = null;
            $user->usesSocialMedia = null;
        }
    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        $profileImage = $request->file('profile_image');
        $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
        $profileImage->move(public_path('UsersProfileImages'), $imageName);

        // Check if the user already has a profile image
        if ($user->profile_image) {
            // Delete the old profile image
            File::delete(public_path($user->profile_image));
        }
        
        // Update the user's profile image path in the database
        $user->profile_image = 'UsersProfileImages/' . $imageName;
    }
        // Save the updated user
        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }




    public function ProfessionalSwitchToBuyer()
    {
        $id = session('UserAuth')->id;
        $user = User::where('id', $id)->first();
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->role = 'GetService';
        $user->save();
        Session::forget('UserAuth');
            return redirect('/login')->with('success', 'Now you are a Buyer. Login Again!');
    }




    public function ProfessionalGetContectDetailsSubmit(Request $request)
    {
        $data = [
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'), 
            'email' => $request->input('email'),
            'postcode' => $request->input('postcode'),
            'credits' => $request->input('credits'),
            'LoginedUserEmail' => $request->input('LoginedUserEmail')
        ];
    
        Mail::send('Users.Professional.Emails.contact-details', $data, function($message) use ($data) {
            $message->to($data['LoginedUserEmail'])
                    ->subject('Contact Details');
        });


        $user = User::where('email', $data['LoginedUserEmail'])->first();
        $user->balance -= $data['credits']; 
        $user->save();


        $transitions= Transitions::create([
            'LoginedUserEmail' => $request->input('LoginedUserEmail'),
            'name' => $request->input('name'), 
            'phone_number' => $request->input('phone_number'), 
            'email' => $request->input('email'),
            'postcode' => $request->input('postcode'),
            'credits' => $request->input('credits'),
            'created_at' => Carbon::now(),
        ]);
        $transitions->save();
    
        // Naya functionality: LoginedUserEmail se user ka data fetch karna
        $loginedUser = User::where('email', $data['LoginedUserEmail'])->first();
            
        // Naye data ko email mein include karna
        $additionalData = [
            'logined_user_name' => $loginedUser->name,
            'logined_user_phone_number' => $loginedUser->phone_number,
            'logined_user_email' => $loginedUser->email,
            
            // 'logined_user_service' => $loginedUser->service,
        ];

        // Email send karna $request->input('email') pr
        Mail::send('Users.Professional.Emails.professional-data', $additionalData, function($message) use ($data) {
            $message->to($data['email']) // Receiving email
                    ->subject('Someone buy your Detials | Weconnectt');
        });

        return redirect('/professional-dashboard/leads')->with('success', 'Contact details successfully emailed! They have also been stored in the payment details section for anytime, anywhere access.');

    }



    public function ProfessionalSendEmailsForFeedback(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            's_email' => 'required|email',
            'r_email' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the sender's email and recipient emails
        $senderEmail = $request->input('s_email');
        $recipients = $request->input('r_email');

        $senderDetails = User::where('email', $senderEmail)->get();

        // Split the recipients by comma and filter out any invalid emails
        $emails = array_filter(array_map('trim', explode(',', $recipients)), function ($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        });

        // Loop through each email and send the message
        foreach ($emails as $email) {
            // Send the email
            Mail::send('Users.Professional.Emails.ReviewRequest', ['sender_details' => $senderDetails, 'senderEmail' => $senderEmail], function ($message) use ($email, $senderEmail, $senderDetails) {
                
                $message->to($email)->subject('Feedback Request ');
            });
        }

        return redirect()->back()->with('success', 'Emails sent successfully!');
    }

    public function ProfessionalReviewFormView($senderEmail)
    {

    return view('Users.Professional.Profile.write-review', ['senderEmail' => $senderEmail]);
    }



    public function StoreReviews(Request $request)
{
    $review = new ClientReviews();
    $review->feedbacker_name = $request->feedbacker_name;
    $review->feedbacker_email = $request->feedbacker_email;
    $review->feedback = $request->feedback;
    $review->rating = $request->rating;
    $review->email = $request->email;
    $review->date = $request->date;

    // Save the review to the database
    $review->save();

    // Prepare data for the email
    $data = [
        'feedbacker_name' => $request->feedbacker_name,
        'feedbacker_email' => $request->feedbacker_email,
        'feedback' => $request->feedback,
        'rating' => $request->rating
    ];

    // Send the email
    Mail::send('Users.Professional.Emails.review-get', $data, function($message) use ($request) {
        $message->to($request->email)
                ->subject('You have received a new review');
    });

    // Redirect back with a success message
    return view('Users.Professional.Profile.thank-you');
}



    public function ProfessionalLocationUpdate(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->customer_serve = $request->customer_serve;
        if ($request->customer_serve == 'postcode') {
            $user->miles = $request->miles;
            $user->postcode = $request->postcode;
        } else {
            $user->miles = null;
            $user->postcode = null;
        }

        // Save the user data
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Location updated successfully.');
    }
    ///Professional Service Update 
    public function updateServiceProfessional(Request $request, $id)
    {
        // Validate the request data
      

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user data
        $user->service = implode(',', $request->service ?? []);

     
        
        // Save the user data
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Service settings updated successfully!');
    }




  public function ProfessionalPhotoUpload(Request $request)
    {
        
        // dd('Hy');
        // Validate the request
        $request->validate([
            'user_email' => 'required|email',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Path to store images
        $path = public_path('PortfolioImages');

        // Create folder if not exists
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // Loop through each uploaded image and save them
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Generate a unique name for each image
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Move image to public folder
                $image->move($path, $imageName);

                // Save the image path and user email in the database
                PortfolioImages::create([
                    'user_email' => $request->user_email,
                    'image_path' => 'PortfolioImages/' . $imageName,
                ]);
            }
        }

        // Redirect back with success message
        return back()->with('success', 'Photos saved successfully.');
    }



public function ProfessionalPhotoDelete(Request $request)
{
    // Validate the request
    $request->validate([
        'id' => 'required|integer|exists:portfolio_images,id',
    ]);

    // Find the image by ID
    $image = PortfolioImages::find($request->id);

    // Delete the image file from storage
    $imagePath = public_path($image->image_path);
    if (File::exists($imagePath)) {
        File::delete($imagePath);
    }

    // Delete the record from the database
    $image->delete();

    // Return a success response
    return response()->json(['success' => 'Image deleted successfully.']);
}









// ------------------------- Get Service ---------------------- // 



    public function GetServiceProfileUpdate(Request $request)
    {
        $user = User::where('id', $request->input('id'))->first();
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }
        
        $oldEmail = $user->email;

        // Update user's information
        $user->name = $request->input('name');
        $user->phone_number = $request->input('phone_number');
    

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('UsersProfileImages'), $imageName);

            // Check if the user already has a profile image
            if ($user->profile_image) {
                // Delete the old profile image
                File::delete(public_path($user->profile_image));
            }
            
            // Update the user's profile image path in the database
            $user->profile_image = 'UsersProfileImages/' . $imageName;
        }

        // Save the updated user
        $user->save();


        if ($oldEmail !== $user->email) {
            Posts::where('email', $oldEmail)->update(['email' => $user->email]);
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }


    public function GetServieUpdatePassword(Request $request) {
        // Validate the request data
        

        $user = User::where('id', $request->input('id'))->first();
        // dd($user);
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match.');
        }

        // Update the user's password
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function GetServieSwitchToSeller()
    {
        $id = session('UserAuth')->id;
        $user = User::where('id', $id)->first();
        if (!$user) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }
        $user->role = 'Professional';
        $user->save();
        Session::forget('UserAuth');
            return redirect('/login')->with('success', 'Now you are a seller. Login Again!');
    }

    //Update store password
    public function UpdatePasswordUser(Request $request, $id) 
    {
        $user = User::find($id);

        // Validate current password
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        // Update new password
        $user->password = Hash::make($request->input('password'));
        $user->save();
        Session::forget('UserAuth');

        return redirect('/login')->with('success', 'Password updated successfully! Login Again.');
    }



    public function GetServiceMarkRequestComplete($id)
    {
        $post = Posts::find($id);
        if ($post) {
            $post->status = 0; // Assuming 0 means complete
            $post->save();
            return redirect()->back()->with('success', 'Request marked as complete');
        }
        return redirect()->back()->with('error', 'Request not found');
    }

    

}
