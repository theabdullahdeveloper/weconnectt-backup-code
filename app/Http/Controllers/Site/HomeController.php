<?php

namespace App\Http\Controllers\Site;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\FeaturedOn;
use App\Models\Testimonials;
use App\Models\PostCredits;
use App\Models\ThemeSettings;
use App\Models\TermsAndConditions;
use App\Models\PravicyPolicy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function siteIndex()
     {
        $themeSetting = ThemeSettings::find(1);
    
    // If it does not exist, insert a new row with id 1 and other fields as null
    if (is_null($themeSetting)) {
        ThemeSettings::create([
            'id' => 1,
            'favicon' => '0',
            'logo' => '0',
            'facebook_link' => '',
            'twitter_link' => '',
            'linkedin_link' => '',
            'header_Links' => '',
            'footer_copyright' => '2024 Weconnectt',
            'c_email' => 'info@weconnectt.com',
            'c_no' => '000',
        ]);
    }
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $sub_categories = ServiceSubCategory::where('service_sub_category_status', 'Active')->with('questions.answers')->get();
        
        $FeaturedOn = FeaturedOn::all();
        $Testimonials = Testimonials::inRandomOrder()->take(11)->get();

      
        $post_credits = PostCredits::all();
        
        return view('Site.index', compact('categories', 'sub_categories','FeaturedOn','Testimonials','post_credits'));
    }

    public function SiteAllSubcategoryAgaintCategory($service_category)
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
       
        $sub_categories = ServiceSubCategory::where('service_sub_category_parent', $service_category)->where('service_sub_category_status', 'Active')->with('questions.answers')->get();
        $post_credits = PostCredits::all();
        return view('Site.all-sub-categories' , compact('sub_categories','post_credits' , 'categories'));
    }
    
    public function SiteAllCategories()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.all-categories' , compact('categories'));
    }
     public function SiteAbout()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.about' , compact('categories'));
    }
    
    
    
    
    public function SiteHowitWorks()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.how-it-works' , compact('categories'));
    }
    
    public function SiteHowitWorkscustomers()
    {
           $post_credits = PostCredits::all();
        $sub_categories = ServiceSubCategory::where('service_sub_category_status', 'Active')->with('questions.answers')->get();
        
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.how-it-works-customers' , compact('categories','sub_categories','post_credits'));
    }

    public function SiteTermsAndConditions()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $tc = TermsAndConditions::first();
        return view('Site.terms-and-conditions' , compact('categories','tc'));
    }
    
     public function SitePrivacyPolicy()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        $pp = PravicyPolicy::first();
        return view('Site.privacy-policies' , compact('categories','pp'));
    }

    public function SiteWeChoseUs()
    {
        $categories = ServiceCategory::where('service_category_status', 'Active')->get();
        return view('Site.why-chose-us' , compact('categories'));
    }


   
   

}
