<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\FeaturedOn;
use App\Models\OurClients;
use App\Models\Testimonials;
use App\Models\User;
use App\Models\ThemeSettings;
use App\Models\PostCredits;
use App\Models\TermsAndConditions;
use App\Models\PravicyPolicy;


class AdminHomeController extends Controller
{
    public function AdminIndex()
    {
        $User_count = User::count();
        $SellerCount = User::where('role', 'professional')->count();
        $BuyerCount = User::where('role', 'getservice')->count();
        $OurClients_count = OurClients::count();
        $ServiceCategory_count = ServiceCategory::count();
        $ServiceSubCategory_count = ServiceSubCategory::count();
        $FeaturedOn_count = FeaturedOn::count();
        $Testimonials_count = Testimonials::count();

        return view('Admin.index',compact('User_count','SellerCount','BuyerCount','OurClients_count','ServiceCategory_count','ServiceSubCategory_count','FeaturedOn_count','Testimonials_count'));
    }


    // Service Category Crud

    public function AddServiceCategory()
    {
        return view('Admin.Service-Category-Crud.add-service-category');
    }


    public function ListServiceCategory()
    {
        $service_categories_count = ServiceCategory::count();
        $service_categories = ServiceCategory::all();
        return view('Admin.Service-Category-Crud.list-service-category', compact('service_categories_count','service_categories'));
    }

    public function ManageViewServiceCategory($service_category)
    {
        $m_service_category = ServiceCategory::where('service_category', $service_category)->get();
        
        if (!$m_service_category) {
            return redirect()->back()->with('error', 'Service Category Not Found.');
        }
        
        return view('Admin.Service-Category-Crud.manage-service-category', compact('m_service_category'));
    }
    

    public function EditServiceCategory($service_category)
    {
        $e_service_category = ServiceCategory::where('service_category', $service_category)->get();
        
        if (!$e_service_category) {
            return redirect()->back()->with('error', 'Service Category Not Found.');
        }
        
        return view('Admin.Service-Category-Crud.edit-service-category', compact('e_service_category'));
    }
    
    public function ViewServiceCategory($service_category)
    {
        $v_service_category = ServiceCategory::where('service_category', $service_category)->get();
        
        if (!$v_service_category) {
            return redirect()->back()->with('error', 'Service Category Not Found.');
        }
        
        return view('Admin.Service-Category-Crud.view-service-category', compact('v_service_category'));
    }



       // Service Sub-Category Crud

    public function AddServiceSubCategory()
    {
        $active_service_categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Admin.Service-Sub-Category-Crud.add-service-sub-category' , compact('active_service_categories'));
    }

    public function ListServiceSubCategory()
    {
        $service_sub_categories_count = ServiceSubCategory::count();
        $service_sub_categories = ServiceSubCategory::all();
        return view('Admin.Service-Sub-Category-Crud.list-service-sub-category' , compact('service_sub_categories_count', 'service_sub_categories'));
    }



    public function ViewServiceSubCategory($service_sub_category)
    {
        // Retrieve the service sub-category with its questions and answers loaded
        $v_service_sub_category = ServiceSubCategory::where('service_sub_category', $service_sub_category)
        ->with('questions.answers')
        ->get();
        
        // Check if the service sub-category exists
        if (!$v_service_sub_category) {
            return redirect()->back()->with('error', 'Service Sub-Category Not Found.');
        }
        
        // Pass the data to the view
        return view('Admin.Service-Sub-Category-Crud.view-service-sub-category', compact('v_service_sub_category'));
    }

    public function EditServiceSubCategory($service_sub_category)
    {
        $subcategory = ServiceSubCategory::where('service_sub_category', $service_sub_category)->first();
        $service_categories = ServiceCategory::all();
    
        if (!$subcategory) {
            return redirect()->back()->with('error', 'Service Sub-Category Not Found.');
        }
        
        return view('Admin.Service-Sub-Category-Crud.edit-service-sub-category', compact('subcategory', 'service_categories'));
    }

    public function EditCreditDetialsServiceSubCategory($service_sub_category)
    {
        $subcategory = ServiceSubCategory::where('service_sub_category', $service_sub_category)->first();
    $service_categories = ServiceCategory::all();
    $credits = PostCredits::where('service_sub_category', $service_sub_category)->where('service_sub_category_parent', $subcategory->service_sub_category_parent)->get();
// dd($credits);
    if (!$subcategory) {
        return redirect()->back()->with('error', 'Service Sub-Category Not Found.');
    }
    
    return view('Admin.Service-Sub-Category-Crud.edit-credits-question-answers', compact('subcategory', 'service_categories', 'credits'));
    }
    
    
    public function ListFeaturedBy()
    {
        $FeaturedOn_count = FeaturedOn::count();
        $FeaturedOn = FeaturedOn::all();
        return view('Admin.Featured-on-crud.list-featured-on' , compact('FeaturedOn_count', 'FeaturedOn'));
    }
    public function ListOurClients()
    {
        $OurClients_count = OurClients::count();
        $OurClients = OurClients::all();
        return view('Admin.Our-Clients-Crud.list-our-clients' , compact('OurClients_count', 'OurClients'));
    }

    public function ListTestimonial()
    {
        $Testimonials_count = Testimonials::count();
        $Testimonials = Testimonials::all();
        return view('Admin.Testimonials-Crud.list-testimonial' , compact('Testimonials_count', 'Testimonials'));
    }
    public function AllUsers()
    {
        $User_count = User::count();
        $User = User::all();
        return view('Admin.Users-list.all-users' , compact('User_count', 'User'));
    }

    //Theme settings
    public function ThemeSettings()
    {
        $themedata = ThemeSettings::all();
        return view('Admin.Theme-settings.settings',compact('themedata'));
    }
    
      public function TermsAndConditions()
    {
        $tc = TermsAndConditions::first();
        if ($tc) {
            return view('Admin.Terms-and-Conditions.terms-conditions', ['tc' => $tc]);
        } else {
            $tc = new TermsAndConditions();
            $tc->save();
            return view('Admin.Terms-and-Conditions.terms-conditions', ['tc' => $tc]);
        }
    }


    public function PravicyPolicy()
    {
        $pp = PravicyPolicy::first();
        if ($pp) {
            return view('Admin.Pravicy-Policy.privacy-policy', ['pp' => $pp]);
        } else {
            $pp = new PravicyPolicy();
            $pp->save();
            return view('Admin.Pravicy-Policy.privacy-policy', ['pp' => $pp]);
        }
    }

}
