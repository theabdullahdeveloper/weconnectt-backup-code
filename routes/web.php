<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\FunctionalController;



use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminFunctionalController;
use App\Http\Controllers\Admin\AdminAuthController;



use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\User\UserFunctionalController;


use App\Http\Controllers\StripeController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });








//    -------------------------  Site  --------------------------- // 

// Auth 
Route::get('/login', [AuthController::class , 'LoginForm']); 
Route::get('/user/password/forgot', [AuthController::class , 'ForgotPasswordView']);  
Route::post('/user/password/forgot/link/send/successfully', [AuthController::class , 'ForgotPasswordSubmit'])->name('submit.forgot.form'); 
Route::get('/user/reset-password/{token?}',[AuthController::class,'showResetPasswordForm'])->name('reset.password.get');
Route::post('/user/password/change/successfully', [AuthController::class , 'SubmitResetPasswordForm'])->name('change.password.done'); 
Route::post('/user/email/verify/send', [AuthController::class, 'SendVerifyEmail'])->name('send.verify.email');
Route::post('/user/email/verify/resend', [AuthController::class, 'ResendVerifyEmail'])->name('resend.verify.email');
Route::get('/user/email/verified/{token?}',[AuthController::class,'ShowVerifyEmailForm'])->name('user.email.verified');
Route::post('/user/opt/verify', [AuthController::class, 'CheckOtp'])->name('opt.check');


// Get Service Account
Route::get('/account/create/get/service/account/{email}', [AuthController::class , 'GetServiceRegisterView'])->name('getservice.account.register.view'); 
Route::post('/account/create/get/service/successfully', [AuthController::class , 'GetServiceUserStore'])->name('get.service.store'); // Store Det Survice


// Professtional Account

Route::get('/account/professional/account/starter', [AuthController::class , 'professionalAccountStartView']);
Route::post('/account/professional/service/', [AuthController::class , 'professionalAccountStartStore'])->name('category.prof.store'); 
Route::get('/create/account/professional/account/{category}', [AuthController::class , 'ProfessionalAccountRegisterView'])->name('professional.account.register.view');
Route::post('/submit/professional/service/account/successfully', [AuthController::class , 'StoreProfessionalAccountUser'])->name('store.professional.user'); 




// Index Page 
Route::get('/', [HomeController::class , 'siteIndex']); 

// All  Categories Against
Route::get('/all/services', [HomeController::class , 'SiteAllCategories']); 

//about
Route::get('/about', [HomeController::class , 'SiteAbout']); 
//how it works
Route::get('/how-it-works/sellers', [HomeController::class , 'SiteHowitWorks']); 
Route::get('/how-it-works/customers', [HomeController::class , 'SiteHowitWorkscustomers']); 
//SiteTermsAndConditions
Route::get('/term/and/conditions', [HomeController::class , 'SiteTermsAndConditions']); 
//SitePrivacyPolicy
Route::get('/privacy/and/policies', [HomeController::class , 'SitePrivacyPolicy']); 
//SiteWeChoseUs
Route::get('/why/choose/us', [HomeController::class , 'SiteWeChoseUs']); 

// All Sub Categories Against parent
Route::get('/all/sub-services/{service_category}', [HomeController::class , 'SiteAllSubcategoryAgaintCategory']); 
// Post
Route::post('/post/submit/successfully', [FunctionalController::class, 'storePost'])->name('post.submit');
Route::post('/check/email/account', [FunctionalController::class, 'checkEmail'])->name('check.email');


Route::post('/send-otp', [FunctionalController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-otp', [FunctionalController::class, 'verifyOtp'])->name('verify.otp');








//    -------------------------  Admin  --------------------------- // 

// Admin Auth 
Route::get('/weconnectt-login', [AdminAuthController::class , 'AdminLoginForm']); 
Route::post('/admin/login/successfully', [AdminAuthController::class , 'admin_authenticate'])->name('admin.authenticate'); 
Route::get('/weconnectt-logout', [AdminAuthController::class , 'AdminLogout']); 



// Index Page 
Route::get('/admin-dashboard', [AdminHomeController::class , 'AdminIndex'])->middleware('AdminAuth'); 


// Service Category 
Route::get('/admin/add/new/service/category', [AdminHomeController::class , 'AddServiceCategory'])->middleware('AdminAuth');  // UI View
Route::post('/admin/store/service/category', [AdminFunctionalController::class, 'ServiceCategoryStore'])->name('store.category')->middleware('AdminAuth'); // Store
Route::get('/admin/add/list/service/categories', [AdminHomeController::class , 'ListServiceCategory'])->middleware('AdminAuth');  // View List UI
Route::get('/admin/manage/service/category/{service_category}', [AdminHomeController::class , 'ManageViewServiceCategory'])->middleware('AdminAuth'); // Manage UI
Route::post('/admin/manage/service/category/update', [AdminFunctionalController::class , 'StoreManageServiceCategory'])->name('store.manage.category')->middleware('AdminAuth'); // Manage Store
Route::get('/admin/edit/service/category/{service_category}', [AdminHomeController::class , 'EditServiceCategory'])->middleware('AdminAuth'); // Edit UI
Route::post('/admin/update/service/category/successfully', [AdminFunctionalController::class , 'UpdateServiceCategory'])->name('update.category')->middleware('AdminAuth'); // Update 
Route::get('/admin/view/service/category/{service_category}', [AdminHomeController::class , 'ViewServiceCategory'])->middleware('AdminAuth'); // View UI
Route::get('/admin/delete/service/category/{service_category}', [AdminFunctionalController::class , 'DeleteServiceCategory'])->middleware('AdminAuth'); // Delete




// Service Sub-Category
Route::get('/admin/add/new/service/sub-category', [AdminHomeController::class , 'AddServiceSubCategory'])->middleware('AdminAuth');  // Form UI
Route::post('/admin/store/service/sub-category', [AdminFunctionalController::class, 'StoreServiceSubCategory'])->name('store.sub.category')->middleware('AdminAuth'); // Store
Route::get('/admin/add/list/service/sub-categories', [AdminHomeController::class , 'ListServiceSubCategory'])->middleware('AdminAuth');  // List
Route::get('/admin/view/service/sub-category/{service_sub_category}', [AdminHomeController::class , 'ViewServiceSubCategory'])->middleware('AdminAuth'); // View UI
Route::get('/admin/edit/service/sub-category/{service_sub_category}', [AdminHomeController::class , 'EditServiceSubCategory'])->middleware('AdminAuth'); // Edit UI
Route::put('/admin/update/service/sub-category/{id}', [AdminFunctionalController::class, 'UpdateServiceSubCategory'])->name('update.sub.category')->middleware('AdminAuth');
Route::get('/admin/update/service/sub-category/credits/details/{service_sub_category}', [AdminHomeController::class, 'EditCreditDetialsServiceSubCategory'])->middleware('AdminAuth');
Route::post('/admin/update/service/sub-category/update-sub-category-credits/{service_sub_category}', [AdminFunctionalController::class, 'UpdateCreditDetailsServiceSubCategory'])->name('update.sub.category.credits');

Route::get('/admin/delete/service/sub-category/{service_sub_category}', [AdminFunctionalController::class , 'DeleteServiceSubCategory'])->middleware('AdminAuth'); // Delete


//Featured On
Route::get('/admin/add/new/featured-on/featured-by', [AdminHomeController::class , 'ListFeaturedBy'])->middleware('AdminAuth');;  // List
Route::post('/admin/add/new/featured-on/featured-by/successfully', [AdminFunctionalController::class , 'PostFeaturedBy'])->name('post.featuredbylogo')->middleware('AdminAuth');  // Update 
Route::get('/admin/delete/new/featured-on/featured-by/{id}', [AdminFunctionalController::class , 'deleteFeaturedBy'])->middleware('AdminAuth'); // Delete

//our clients
Route::get('/admin/add/new/clients/list', [AdminHomeController::class , 'ListOurClients'])->middleware('AdminAuth');;  // List
Route::post('/admin/add/new/clients/successfully', [AdminFunctionalController::class , 'PostOurClient'])->name('post.ourclient')->middleware('AdminAuth');  // Update 
Route::get('/admin/delete/new/our-client/{id}', [AdminFunctionalController::class , 'deleteOurClient'])->middleware('AdminAuth'); // Delete

//Testimonials
Route::get('/admin/add/new/testimonial/list', [AdminHomeController::class , 'ListTestimonial'])->middleware('AdminAuth');;  // List
Route::post('/admin/add/new/testimonial/successfully', [AdminFunctionalController::class , 'PostTestimonial'])->name('post.testimonial')->middleware('AdminAuth');  // Update 
Route::get('/admin/delete/new/testimonial/{id}', [AdminFunctionalController::class , 'deleteTestimonial'])->middleware('AdminAuth'); // Delete


///All-users
Route::get('/admin/users/all', [AdminHomeController::class , 'AllUsers'])->middleware('AdminAuth');  // List

//Theme Settings
Route::get('/admin/theme/settings', [AdminHomeController::class , 'ThemeSettings'])->middleware('AdminAuth');;  // List
Route::post('/admin/theme/update/settings/successfully', [AdminFunctionalController::class , 'UpdateThemesettings'])->name('update.themesettings')->middleware('AdminAuth');  // Update 


// Terms and Conditions
Route::get('/admin/terms/and/conditions', [AdminHomeController::class , 'TermsAndConditions'])->middleware('AdminAuth')->name('TermsAndConditions');  // View 
Route::post('/admin/terms/and/conditions/update', [AdminFunctionalController::class, 'updateTermsAndConditions'])->middleware('AdminAuth')->name('updateTermsAndConditions'); // update

// Pravicy and policies
Route::get('/admin/pravicy/and/policy', [AdminHomeController::class , 'PravicyPolicy'])->middleware('AdminAuth')->name('PravicyPolicy');  // View 
Route::post('/admin/pravicy/and/policy/update', [AdminFunctionalController::class, 'updatePravicyPolicy'])->middleware('AdminAuth')->name('updatePravicyPolicy'); // update



//    -------------------------  Users  --------------------------- // 

// Auth
Route::post('/user/login/successfully', [UserAuthController::class , 'UserAuthenticateSubmit'])->name('user.authenticate'); 
Route::get('/user/logout', [UserAuthController::class , 'UserLogout']); // Logout 


// Get Service Dashboard 
Route::get('/get/service/dashboard', [UserHomeController::class , 'GetServiceIndexView'])->middleware('UserAuth'); 
Route::get('/get/service/dashboard/completed/requests', [UserHomeController::class , 'GetServiceCompelteRequestsView'])->middleware('UserAuth'); 
Route::get('/get/service/dashboard/mark/request/complete/{id}', [UserFunctionalController::class , 'GetServiceMarkRequestComplete'])->middleware('UserAuth'); 
Route::get('/get/service/user/setting/{id}', [UserHomeController::class , 'GetServiceSettingView'])->name('get.service.setting')->middleware('UserAuth'); 
Route::post('/get/service/user/setting/update/successfully', [UserFunctionalController::class , 'GetServiceProfileUpdate'])->name('get.service.user.update')->middleware('UserAuth');
Route::post('/get/service/user/password/update/successfully', [UserFunctionalController::class , 'GetServieUpdatePassword'])->name('get.service.password.update')->middleware('UserAuth');
Route::get('/get/service/user/switch/to/seller', [UserFunctionalController::class , 'GetServieSwitchToSeller'])->middleware('UserAuth');


// ===========Professional Dashboard================ 
Route::get('/professional-dashboard', [UserHomeController::class , 'ProfessionalIndexView'])->middleware('UserAuth'); 
Route::get('/professional-dashboard/leads', [UserHomeController::class , 'ProfessionalLeadView'])->middleware('UserAuth'); 
Route::get('/professional-dashboard/settings/{id}', [UserHomeController::class , 'ProfessionalSettingsView'])->middleware('UserAuth'); 
Route::post('/professional-dashboard/update/successfully', [UserFunctionalController::class , 'UpdateProfessionalAccountUser'])->name('user.professional.update')->middleware('UserAuth'); 
Route::get('/professional/user/switch/to/buyer', [UserFunctionalController::class , 'ProfessionalSwitchToBuyer'])->middleware('UserAuth'); 
Route::post('/professional-dashboard/get/contact/details/successfully', [UserFunctionalController::class , 'ProfessionalGetContectDetailsSubmit'])->name('professional.get.contact.details.submit')->middleware('UserAuth'); 
Route::get('/professional/user/payment/details/get', [UserHomeController::class , 'ProfessionalPaymentDetails'])->middleware('UserAuth'); 
Route::post('/professional/settings/update/password/{id}', [UserFunctionalController::class, 'UpdatePasswordUser'])->name('professional.settings.update.password')->middleware('UserAuth');
Route::post('/professional/settings/update/service/{id}', [UserFunctionalController::class, 'updateServiceProfessional'])->name('professional.settings.update.service')->middleware('UserAuth');
Route::post('/professional/settings/update/location/{id}', [UserFunctionalController::class, 'ProfessionalLocationUpdate'])->name('professional.location.update')->middleware('UserAuth');
Route::get('/professional/public/profile/{email}', [UserHomeController::class , 'ProfessionalPublicProfileView']); // MiddleWare Nhi Lagaana
Route::post('/professional/send/emails/for/feedback', [UserFunctionalController::class, 'ProfessionalSendEmailsForFeedback'])->name('professional.send.emails')->middleware('UserAuth');
Route::get('/write/honest/review/for/{senderEmail}', [UserFunctionalController::class , 'ProfessionalReviewFormView']); // MiddleWare Nhi Lagaana
Route::post('/review/store/successfully', [UserFunctionalController::class , 'StoreReviews'])->name('store.review');

// Stripe 

Route::get('/user/payment/stripe/{email}', [StripeController::class , 'stripeformView'])->middleware('UserAuth'); 
Route::post('/stripe/payment', [StripeController::class, 'stripePost'])->name('stripe.post')->middleware('UserAuth');
Route::get('/professional-dashboard/user/credits/details', [StripeController::class, 'UserCreditsDetailsTable'])->middleware('UserAuth');


// photos
Route::post('/professional/upload/photos', [UserFunctionalController::class, 'ProfessionalPhotoUpload'])->name('professional.photo.upload')->middleware('UserAuth');

Route::post('/professional/delete/photo', [UserFunctionalController::class, 'ProfessionalPhotoDelete'])->name('Images_delete')->middleware('UserAuth');




