<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\SubCategoryQuestions;
use App\Models\SubCategoryAnswers;
use App\Models\FeaturedOn;
use App\Models\OurClients;
use App\Models\Testimonials;
use App\Models\ThemeSettings;
use App\Models\PostCredits;
use App\Models\Posts;
use App\Models\User;
use App\Models\QuestionAnswerByUserForPost;
use Illuminate\Support\Facades\DB;
use App\Models\TermsAndConditions;
use App\Models\PravicyPolicy;



class AdminFunctionalController extends Controller
{


        // ------------Service Category Crud------------------- //



    // Store  
        public function ServiceCategoryStore(Request $request)
        {
            

                    // Check if the service category already exists
            $existingCategory = ServiceCategory::where('service_category', $request->input('service_category'))->first();

            if ($existingCategory) {
                // If the category already exists, return back with an error message
                return redirect()->back()->with('error', 'Category already exists.');
            }

            $imageName = time().'.'.$request->service_category_image->extension();
            $request->service_category_image->move(public_path('Service-Category-Images'), $imageName);
            $imagePath = 'Service-Category-Images/'.$imageName;

            // Create a new service category
            $category = new ServiceCategory;
            $category->service_category = $request->input('service_category');
            $category->service_category_image = $imagePath;
            $category->service_category_status = $request->input('service_category_status');
            $category->available_online = $request->input('available_online');
            $category->save();

            // Redirect back with success message
            return redirect()->back()->with('success', 'Category Created Successfully.');
        }

     // Manage 

        public function StoreManageServiceCategory(Request $request)
        {
            $m = ServiceCategory::where('service_category', $request->input('service_category'))->first();
            if (!$m) {
                return redirect()->back()->with('error', 'Service Category Not Found.');
            }
            $m->view_swipper = $request->input('view_swipper');
            $view_icon_line = $request->input('view_icon_line');
            $icon_color = $request->input('icon_color');
            $icon_class = $view_icon_line == '0' ? null : 'bi bi-' . $request->input('icon_class');
            
            $m->view_icon_line = $view_icon_line;
            $m->icon_color = $icon_color;
            $m->icon_class = $icon_class;
            
            $m->save();
        
            return redirect('/admin/add/list/service/categories')->with('success', $request->input('service_category') . ' Category Manage Successfully!');

        }
        // Update
        public function UpdateServiceCategory(Request $request)
        {
            // Find the category by id
            $id = $request->input('id');
            $category = ServiceCategory::findOrFail($id);

            // Check if the updated service category name conflicts with existing ones
            if ($request->input('service_category') !== $category->service_category) {
                $existingCategory = ServiceCategory::where('service_category', $request->input('service_category'))->first();

                if ($existingCategory) {
                    // If the category already exists, return back with an error message
                    return redirect()->back()->with('error', 'Category already exists.');
                }
            }

            // Begin transaction
            DB::beginTransaction();

            try {
                // Check if there's a new image uploaded
                if ($request->hasFile('service_category_image')) {
                    // Delete the previous image
                    if (File::exists(public_path($category->service_category_image))) {
                        File::delete(public_path($category->service_category_image));
                    }
                    // Upload and save the new image
                    $imageName = time().'.'.$request->service_category_image->extension();
                    $request->service_category_image->move(public_path('Service-Category-Images'), $imageName);
                    $category->service_category_image = 'Service-Category-Images/'.$imageName;
                }

                // Update the category fields
                $oldServiceCategory = $category->service_category;
                $category->service_category = $request->input('service_category');
                $category->service_category_status = $request->input('service_category_status');
                $category->available_online = $request->input('available_online');
                $category->save();

                // Update related records in ServiceSubCategory
                ServiceSubCategory::where('service_sub_category_parent', $oldServiceCategory)
                    ->update(['service_sub_category_parent' => $category->service_category]);

                // Update related records in SubCategoryQuestions
            

                // Update related records in PostCredits
                PostCredits::where('service_sub_category_parent', $oldServiceCategory)
                    ->update(['service_sub_category_parent' => $category->service_category]);

                // Update related records in Posts
                Posts::where('service_sub_category_parent', $oldServiceCategory)
                    ->update(['service_sub_category_parent' => $category->service_category]);

            
                // Update users' service categories
                $users = User::where('service', 'LIKE', "%$oldServiceCategory%")->get();

                foreach ($users as $user) {
                    $services = explode(',', $user->service);
                    $updatedServices = array_map(function ($service) use ($oldServiceCategory, $category) {
                        return $service === $oldServiceCategory ? $category->service_category : $service;
                    }, $services);

                    $user->service = implode(',', $updatedServices);
                    $user->save();
                }

                // Commit the transaction
                DB::commit();

                return redirect('/admin/add/list/service/categories')->with('success', $request->input('service_category') . ' Category Updated Successfully!');
            } catch (\Exception $e) {
                // Rollback the transaction if something goes wrong
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred while updating the category: ' . $e->getMessage());
            }
        }


        // Delete 
        public function DeleteServiceCategory($service_category)
        {
            $category = ServiceCategory::where('service_category', $service_category)->first();
            
            if (!$category) {
                return redirect()->back()->with('error', 'Category Not Found.');
            }
        
            // Start a transaction to ensure atomicity
            DB::beginTransaction();
        
            try {
                // Find and delete subcategories associated with the category
                $subcategories = ServiceSubCategory::where('service_sub_category_parent', $service_category)->get();
        
                foreach ($subcategories as $subcategory) {
                    $subcategoryId = $subcategory->id;
        
                    // Delete related questions and answers
                    $questions = SubCategoryQuestions::where('service_sub_category_id', $subcategoryId)->get();
                    foreach ($questions as $question) {
                        // Delete related answers
                        SubCategoryAnswers::where('sub_category_question_id', $question->id)->delete();
                        // Delete the question
                        $question->delete();
                    }
        
                    // Delete related post credits
                    PostCredits::where('service_sub_category', $subcategory->service_sub_category)
                        ->where('service_sub_category_parent', $subcategory->service_sub_category_parent)
                        ->delete();
        
                    // Find all related posts
                    $posts = Posts::where('service_sub_category', $subcategory->service_sub_category)
                        ->where('service_sub_category_parent', $subcategory->service_sub_category_parent)
                        ->get();
                        foreach ($posts as $post) {
                            $post->permanently_disabled = 1;
                            $post->save();
                        }
                    
                   
        
                    // Delete the subcategory image file if exists
                    if ($subcategory->service_sub_category_image) {
                        $imagePath = public_path($subcategory->service_sub_category_image);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
        
                    // Delete the subcategory
                    $subcategory->delete();
                }
        
                // Delete the main category image if exists
                if ($category->service_category_image) {
                    $imagePath = public_path($category->service_category_image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
        

                $users = User::where(function ($query) use ($service_category) {
                    $query->where('service', 'LIKE', "%,$service_category,%")
                          ->orWhere('service', 'LIKE', "%,$service_category")
                          ->orWhere('service', 'LIKE', "$service_category,%")
                          ->orWhere('service', $service_category); // Check if the category is the only one in the service list
                })
                ->get();
   
                foreach ($users as $user) {
                    // Check if the service category is the only one in the list
                    if ($user->service == $service_category) {
                        $user->service = ''; // Set service to empty if it's the only category
                    } else {
                        // Remove the category from the list if it's not the only one
                        $user->service = implode(',', array_diff(explode(',', $user->service), [$service_category]));
                    }
                    $user->save();
                }
   

                // Delete the main category
                $category->delete();
        
                // Commit the transaction
                DB::commit();
        
                return redirect()->back()->with('success', 'Category and associated Subcategories and their data deleted successfully.');
            } catch (\Exception $e) {
                // Rollback the transaction if something goes wrong
                DB::rollBack();
                return redirect()->back()->with('error', 'An error occurred while deleting the category: ' . $e->getMessage());
            }
        }
        



    public function StoreServiceSubCategory(Request $request)
    {
        // Validate the request
        $existingSUBCategory = ServiceSubCategory::where('service_sub_category', $request->input('service_sub_category'))->first();

        if ($existingSUBCategory) {
            // If the category already exists, return back with an error message
            return redirect()->back()->with('error', 'Sub Category already exists.');
        }
        

        // Upload the image
        if ($request->hasFile('service_sub_category_image')) {
            $imageName = time() . '.' . $request->service_sub_category_image->extension();
            $request->service_sub_category_image->move(public_path('Service-Sub-Category-Images'), $imageName);
            $imagePath = 'Service-Sub-Category-Images/' . $imageName;
        } else {
            // Handle case where no image is uploaded
            return redirect()->back()->withErrors(['service_sub_category_image' => 'The image field is required.']);
        }

        // Create a new service category
        $subcategory = new ServiceSubCategory;
        $subcategory->service_sub_category = $request->input('service_sub_category');
        $subcategory->service_sub_category_parent = $request->input('service_sub_category_parent');
        $subcategory->service_sub_category_image = $imagePath;
        $subcategory->service_sub_category_status = $request->input('service_sub_category_status');
        $subcategory->sub_category_available_online = $request->input('sub_category_available_online');
        $subcategory->sub_category_view_index_page = $request->input('sub_category_view_index_page');
        $subcategory->sub_category_icon_class = 'bi bi-' . $request->input('sub_category_icon_class');
        $subcategory->save();
        

        // Store questions and answers
        foreach ($request->questions as $index => $questionData) {
            // Create a new question
            $question = new SubCategoryQuestions();
            $question->question = $questionData;
            $question->service_sub_category_id = $subcategory->id;
            $question->save();
        
            // Check if answers are provided for the current question
            if (isset($request->answers[$index])) {
                foreach ($request->answers[$index] as $answer) {
                    // Create a new answer for the current question
                    $answerModel = new SubCategoryAnswers();
                    $answerModel->answer = $answer;
                    $answerModel->sub_category_question_id = $question->id;
                    $answerModel->save();
                }
            }
        }

        foreach ($request->credit_answers as $key => $answer) {
            PostCredits::create([
                'service_sub_category' => $request->input('service_sub_category'),
                'service_sub_category_parent' => $request->input('service_sub_category_parent'),
                'credit_question' => $request->credit_question,
                'credit_answer' => $answer,
                'credits' => $request->credits[$key],
            ]);
        }

        

        // Redirect back with success message
        return redirect()->back()->with('success', 'Sub-Category Created Successfully.');
    }

    public function UpdateServiceSubCategory(Request $request, $id)
    {
        // Validate the request

        // Find the existing sub-category
        $subcategory = ServiceSubCategory::findOrFail($id);

        // Upload the new image if present
        if ($request->hasFile('service_sub_category_image')) {
            // Delete the old image if it exists
            if (File::exists(public_path($subcategory->service_sub_category_image))) {
                File::delete(public_path($subcategory->service_sub_category_image));
            }

            $imageName = time() . '.' . $request->service_sub_category_image->extension();
            $request->service_sub_category_image->move(public_path('Service-Sub-Category-Images'), $imageName);
            $imagePath = 'Service-Sub-Category-Images/' . $imageName;
        } else {
            // Use the old image if no new image is uploaded
            $imagePath = $subcategory->service_sub_category_image;
        }

        // Store old values before updating
        $oldServiceSubCategory = $subcategory->service_sub_category;
        $oldServiceSubCategoryParent = $subcategory->service_sub_category_parent;

        // Update the sub-category details
        $subcategory->service_sub_category = $request->input('service_sub_category');
        $subcategory->service_sub_category_parent = $request->input('service_sub_category_parent');
        $subcategory->service_sub_category_image = $imagePath;
        $subcategory->service_sub_category_status = $request->input('service_sub_category_status');
        $subcategory->sub_category_available_online = $request->input('sub_category_available_online');
        $subcategory->sub_category_view_index_page = $request->input('sub_category_view_index_page');
        $subcategory->sub_category_icon_class = 'bi bi-' . $request->input('sub_category_icon_class');
        $subcategory->save();

        // Update related records in PostCredits table
        PostCredits::where('service_sub_category', $oldServiceSubCategory)
            ->where('service_sub_category_parent', $oldServiceSubCategoryParent)
            ->update([
                'service_sub_category' => $request->input('service_sub_category'),
                'service_sub_category_parent' => $request->input('service_sub_category_parent')
            ]);

        // Update related records in Posts table
        Posts::where('service_sub_category', $oldServiceSubCategory)
            ->where('service_sub_category_parent', $oldServiceSubCategoryParent)
            ->update([
                'service_sub_category' => $request->input('service_sub_category'),
                'service_sub_category_parent' => $request->input('service_sub_category_parent')
            ]);

    
        // Update questions and answers
        SubCategoryQuestions::where('service_sub_category_id', $subcategory->id)->delete();
        SubCategoryAnswers::where('sub_category_question_id', $subcategory->id)->delete();

        foreach ($request->questions as $index => $questionData) {
            // Create a new question
            $question = new SubCategoryQuestions();
            $question->question = $questionData;
            $question->service_sub_category_id = $subcategory->id;
            $question->save();
        
            // Check if answers are provided for the current question
            if (isset($request->answers[$index])) {
                foreach ($request->answers[$index] as $answer) {
                    // Create a new answer for the current question
                    $answerModel = new SubCategoryAnswers();
                    $answerModel->answer = $answer;
                    $answerModel->sub_category_question_id = $question->id;
                    $answerModel->save();
                }
            }
        }

        // Redirect back with success message
        return redirect('/admin/add/list/service/sub-categories')->with('success', 'Sub-Category Updated Successfully.');
    }

    





    public function UpdateCreditDetailsServiceSubCategory(Request $request, $service_sub_category)
    {
        $subcategory = ServiceSubCategory::where('service_sub_category', $service_sub_category)->first();

        if (!$subcategory) {
            return redirect()->back()->with('error', 'Service Sub-Category Not Found.');
        }

        // Validate the request
        $request->validate([
            'credit_question' => 'required|string',
            'credit_answers' => 'required|array',
            'credits' => 'required|array',
            'credit_answers.*' => 'required|string',
            'credits.*' => 'required|integer',
        ]);

        // Delete existing credits for the sub-category
    PostCredits::where('service_sub_category', $service_sub_category)->where('service_sub_category_parent', $subcategory->service_sub_category_parent)->delete();

        // Insert new credits
        foreach ($request->credit_answers as $index => $answer) {
            PostCredits::create([
                'service_sub_category' => $service_sub_category,
                'service_sub_category_parent' => $subcategory->service_sub_category_parent,
                'credit_question' => $request->credit_question,
                'credit_answer' => $answer,
                'credits' => $request->credits[$index],
            ]);
        }

        return redirect('/admin/add/list/service/sub-categories')->with('success', 'Credits Details Updated Successfully.');
    }


// Deelte
    public function DeleteServiceSubCategory($service_sub_category)
    {
        $subcategory = ServiceSubCategory::where('service_sub_category', $service_sub_category)->first();
        
        if (!$subcategory) {
            return redirect()->back()->withErrors(['error' => 'Sub-category not found.']);
        }
    
        // Start a transaction
        DB::beginTransaction();
        
        try {
            $id = $subcategory->id;
    
            // Delete related questions and answers
            $questions = SubCategoryQuestions::where('service_sub_category_id', $id)->get();
            foreach ($questions as $question) {
                // Delete related answers
                SubCategoryAnswers::where('sub_category_question_id', $question->id)->delete();
                // Delete the question
                $question->delete();
            }
    
            // Delete related post credits
            PostCredits::where('service_sub_category', $subcategory->service_sub_category)
                ->where('service_sub_category_parent', $subcategory->service_sub_category_parent)
                ->delete();
               
    
            // Find all related posts
            $posts = Posts::where('service_sub_category', $subcategory->service_sub_category)
                        ->where('service_sub_category_parent', $subcategory->service_sub_category_parent)
                        ->get();
                        foreach ($posts as $post) {
                            $post->permanently_disabled = 1;
                            $post->save();
                        }
    
            // Delete the service subcategory image file if exists
            if ($subcategory->service_sub_category_image) {
                $imagePath = public_path($subcategory->service_sub_category_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            // Finally, delete the service subcategory
            $subcategory->delete();
    
            // Commit the transaction
            DB::commit();
            
            // Redirect back with success message
            return redirect()->back()->with('success', 'Sub-Category and related data deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'An error occurred while deleting the sub-category: ' . $e->getMessage()]);
        }
    }
    

        

    /////Featured on


    public function PostFeaturedBy(Request $request)
    {
    


        $imageName = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            // Validate image dimensions
        
            // Generate a unique name for the image
            $imageName = time() . '_logo.' . $image->getClientOriginalExtension();
            // Move the image to the destination directory
            $image->move(public_path('Featuredon/Featuredbylogo'), $imageName);
        }
    


        $featuredby = new FeaturedOn;

        // Create a new featuredby instance
        $featuredby->fill([
            'alt' => $request->input('alt'),
            'logo' => $imageName,

        ]);

        // Save the user to the database
        $featuredby->save();

        // Redirect to login page with success message
        return redirect()->back()->with('success', 'Posted Succefully.');
    }
    public function deleteFeaturedBy($id)
    {
        // Find the featured item by its ID
        $featuredby = FeaturedOn::findOrFail($id);

        // Get the image path
        $imagePath = public_path('Featuredon/Featuredbylogo/') . $featuredby->logo;

        // Check if the image file exists, then delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the featured item from the database
        $featuredby->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Featured item deleted successfully.');
    }


    //Our Clients

    public function PostOurClient(Request $request)
    {
    


        $imageName = null;
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            // Validate image dimensions
        
            // Generate a unique name for the image
            $imageName = time() . '_logo.' . $image->getClientOriginalExtension();
            // Move the image to the destination directory
            $image->move(public_path('Ourclients/logos'), $imageName);
        }
    


        $ourclient = new OurClients;

        // Create a new featuredby instance
        $ourclient->fill([
            'alt' => $request->input('alt'),
            'logo' => $imageName,

        ]);

        // Save the user to the database
        $ourclient->save();

        // Redirect to login page with success message
        return redirect()->back()->with('success', 'Listed New Client Succefully.');
    }
    public function deleteOurClient($id)
    {
        // Find the featured item by its ID
        $ourclient = OurClients::findOrFail($id);

        // Get the image path
        $imagePath = public_path('Ourclients/logos/') . $ourclient->logo;

        // Check if the image file exists, then delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the featured item from the database
        $ourclient->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Client deleted successfully.');
    }

    //Testimonials

    public function PostTestimonial(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profession' => 'required|string|max:255',
            'review' => 'required|string',
            'picture' => 'required|image',
        ]);
    
        $imageName = null;
        
        // Check if the picture file is present in the request
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            
            // Suppress the warning from getimagesize
            $imageSize = @getimagesize($image);
    
            // Check if getimagesize was successful
            if ($imageSize === false) {
                return redirect()->back()->withErrors(['picture' => 'The uploaded file is not a valid image.'])->withInput();
            }
    
            
            // Get the dimensions of the image
            list($width, $height) = $imageSize;
            
            // Check if the image is square
            if ($width != $height) {
                return redirect()->back()->withErrors(['picture' => 'The image must be square (equal width and height). Your image was not square. Please upload a square image.'])->withInput();
            }
            
            // Generate a unique name for the image
            $imageName = time() . '_picture.' . $image->getClientOriginalExtension();
            
            // Move the image to the desired location
            $image->move(public_path('Testimonials/pictures'), $imageName);
        }
    
        // Create a new Testimonials instance
        $testimonial = new Testimonials;
        
        // Fill the testimonial attributes
        $testimonial->fill([
            'name' => $request->input('name'),
            'profession' => $request->input('profession'),
            'review' => $request->input('review'),
            'picture' => $imageName,
        ]);
    
        // Save the testimonial
        $testimonial->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Listed New Testimonial Successfully.');
    }
    
    

    public function deleteTestimonial($id)
    {
        // Find the featured item by its ID
        $testimonial = Testimonials::findOrFail($id);

        // Get the image path
        $imagePath = public_path('Testimonials/pictures/') . $testimonial->picture;

        // Check if the image file exists, then delete it
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the featured item from the database
        $testimonial->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Testimonials deleted successfully.');
    }


    ///ThemeSettingsUpdate

    public function UpdateThemesettings(Request $request)
    {
        // Find the user by email
        $themesetting = ThemeSettings::where('id', $request->input('id'))->first();
        if (!$themesetting) {
            // Redirect back with error message if user not found
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update user fields
        $themesetting->facebook_link = $request->input('facebook_link');
        $themesetting->twitter_link = $request->input('twitter_link');
        $themesetting->linkedin_link = $request->input('linkedin_link');
        $themesetting->c_email = $request->input('c_email');
        $themesetting->c_no = $request->input('c_no');
        $themesetting->header_Links = $request->input('header_Links');
        $themesetting->footer_copyright = $request->input('footer_copyright');


    // Handle profile image upload
    if ($request->hasFile('favicon')) {
        $favicon = $request->file('favicon');
        $imageName = time() . '.' . $favicon->getClientOriginalExtension();
        $favicon->move(public_path('Favicon'), $imageName);

        // Check if the user already has a profile image
        if ($themesetting->favicon) {
            // Delete the old profile image
            File::delete(public_path($themesetting->favicon));
        }
        
        // Update the user's profile image path in the database
        $themesetting->favicon = 'Favicon/' . $imageName;
    }

    // Handle profile image upload
    if ($request->hasFile('logo')) {
        $logo = $request->file('logo');
        $imageName = time() . '.' . $logo->getClientOriginalExtension();
        $logo->move(public_path('Logo'), $imageName);

        // Check if the user already has a profile image
        if ($themesetting->logo) {
            // Delete the old profile image
            File::delete(public_path($themesetting->logo));
        }
        
        // Update the user's profile image path in the database
        $themesetting->logo = 'Logo/' . $imageName;
    }
        // Save the updated user
        $themesetting->save();

        return redirect()->back()->with('success', 'Theme setting  updated successfully!');
    }




    // Update Terms and Condition s
    public function updateTermsAndConditions(Request $request)
    {
        $tc = TermsAndConditions::first();
        if (!$tc) {
            $tc = new TermsAndConditions();
        }
        $tc->data = $request->input('editor');
        $tc->save();
        return redirect()->back()->with('success', 'Terms and Conditions updated successfully!');
    }

    // Update Pravicy Policies
    public function updatePravicyPolicy(Request $request)
    {
        $pp = PravicyPolicy::first();
        if (!$pp) {
            $pp = new PravicyPolicy();
        }
        $pp->data = $request->input('editor');
        $pp->save();
        return redirect()->back()->with('success', 'Pravicy and policies updated successfully!');
    }
    
}
