<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\AdminLoginController;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\BoatOwner\BookingController as BoatOwnerBookingController;
use App\Http\Controllers\BoatOwner\CustomerController;
use App\Http\Controllers\BoatOwner\DashboardController as BoatOwnerDashboardController;
use App\Http\Controllers\BoatOwner\ListingController as BoatOwnerListingController;
use App\Http\Controllers\BoatOwner\ProfileController as BoatOwnerProfileController;
use App\Http\Controllers\Customer\BookingController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Site\AjaxController;
use App\Http\Controllers\Site\PagesController;
use Illuminate\Contracts\Session\Session;

Route::middleware('Setlang')->group(function(){
    Route::get('setlang/{lang}', function($lang){
        Session(['lang'=> $lang]);
        return redirect('/');
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('login');
        Route::post('login', [AdminLoginController::class, 'login'])->name('do_login');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    });
    Route::get('/dashboard', function(){
        return redirect()->route('admin.dashboard');
    });
    Route::prefix('admin')->name('admin.')->middleware(['auth:sanctum', 'verified', 'onlyAdmin'])->group(function () {
        Route::get('profile', [AdminLoginController::class, 'profile'])->name('profile');
        Route::put('profile/update', [AdminLoginController::class, 'update'])->name('update');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UsersController::class);
        Route::post('change_status', [UsersController::class, 'changeStatus'])->name('change-status');
        Route::get('boatowner', [UsersController::class, 'index'])->name('boatowner');
        Route::get('customer', [UsersController::class, 'customers'])->name('customer');
        Route::get('listing',[ListingController::class, 'index'])->name('listing');
        Route::get('listing/add-edit/{id?}',[ListingController::class, 'create'])->name('listings');
        Route::post('listing/general-settings/{id?}', [ListingController::class, 'storeGeneralSettings'])->name('general-settings');
        Route::delete('listing/destroy/{id}', [ListingController::class, 'destroy'])->name('listing.destroy');
        Route::post('listing/cover_image/{id?}', [ListingController::class, 'uploadCoverImage'])->name('uploadcoverimage');
        Route::post('listing/upload/{id?}', [ListingController::class, 'uploadImage'])->name('uploadgallery');
        Route::delete('listing/remove', [ListingController::class, 'removeImage'])->name('removegallery'); 
        Route::post('listing/change_status', [ListingController::class, 'changeStatus'])->name('listing.change-status');
        Route::resource('bookings', AdminBookingController::class);  
        Route::resource('blog',BlogController::class);
        Route::post('change_status', [BlogController::class, 'changeStatus'])->name('changestatus');
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');  
        Route::post('setting_update', [SettingController::class, 'storeUpdate'])->name('setting_update');  
        Route::post('upload_logo', [SettingController::class, 'uploadLogo'])->name('upload_logo');  
        Route::post('upload_logo_white', [SettingController::class, 'uploadLogoWhite'])->name('upload_logo_white');  
        Route::get('settings/add-language', [SettingController::class, 'addLanguage'])->name('add-language');  
        Route::get('settings/edit-language/{id}', [SettingController::class, 'edit'])->name('edit-language');  
        Route::post('settings/store-language', [SettingController::class, 'storeLanguage'])->name('store-language');  
        Route::put('settings/update-language/{id}', [SettingController::class, 'update'])->name('update-language');  
        Route::delete('settings/destroy-language/{id}', [SettingController::class, 'destroy'])->name('destroy-language');  
        Route::get('settings/languages', [SettingController::class, 'getLanguages'])->name('languages');  
        Route::post('settings/language-status', [SettingController::class, 'changeStatus'])->name('language-status');  
    });
    Route::prefix('boatowner')->name('boatowner.')->middleware(['auth:sanctum', 'verified', 'onlyBoatowner'])->group(function () {
        Route::get('dashboard', [BoatOwnerDashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [BoatOwnerProfileController::class, 'index'])->name('profile');
        Route::put('update', [BoatOwnerProfileController::class, 'update'])->name('profile.update');
        Route::put('password-update', [BoatOwnerProfileController::class, 'passwordUpdate'])->name('password.update');
        Route::post('/upload-image', [BoatOwnerProfileController::class, 'uploadImage'])->name('profile.image');
        Route::get('listing',[BoatOwnerListingController::class, 'index'])->name('listing');
        Route::get('listing-add',[BoatOwnerListingController::class, 'create'])->name('listing-add');
        Route::post('listing-store',[BoatOwnerListingController::class, 'store'])->name('listing-store');
        Route::post('listing-search',[BoatOwnerListingController::class, 'search'])->name('listing-search');
        Route::post('change-status',[BoatOwnerListingController::class, 'changeStatus'])->name('change-status');
        Route::get('listing/{id}',[BoatOwnerListingController::class, 'edit'])->name('listing.edit');
        Route::post('listing-settings/{id}',[BoatOwnerListingController::class, 'update'])->name('listing-settings');
        Route::post('listing/cover_image/{id}', [BoatOwnerListingController::class, 'uploadCoverImage'])->name('uploadcoverimage');
        Route::post('listing/upload/{id}', [BoatOwnerListingController::class, 'uploadImage'])->name('uploadgallery');
        Route::delete('listing/remove', [BoatOwnerListingController::class, 'removeImage'])->name('removegallery'); 
        Route::get('customers', [CustomerController::class, 'index'])->name('customers'); 
        Route::resource('booking', BoatOwnerBookingController::class);
    });
    Route::prefix('customer')->name('customer.')->middleware(['auth:sanctum', 'verified', 'onlyCustomer'])->group(function () {
        Route::get('dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password-update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
        Route::post('/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.image');
        Route::get('/favourites', [ProfileController::class, 'favourite'])->name('favourite');
        Route::resource('booking', BookingController::class);
    });

    Route::get('/login', function(){
        return redirect()->route('home');
    })->name('login');

    Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
        Route::get('/dashboard', function () {
            return redirect()->route('admin.dashboard');
        })->name('dashboard');
    });

    /* Front Routs */
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

    Route::get('login/facebook', [SocialAuthController::class, 'redirectToFacebook'])->name('facebooklogin');
    Route::get('login/facebook/callback', [SocialAuthController::class, 'handleFacebookCallback']);

    Route::get('login/google', [SocialAuthController::class, 'redirectToGoogle'])->name('googlelogin');
    Route::get('login/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

    Route::get('/boatlogin', [UserRegisterController::class, 'checkBoat'])->name('boatlogin');
    Route::get('/userlogin', [UserRegisterController::class, 'checkUser'])->name('userlogin');
    Route::post('/checkemail', [UserRegisterController::class, 'checkUserEmailLogin'])->name('checkemail');
    Route::get('/register', [UserRegisterController::class, 'index'])->name('register');
    Route::get('/register_your_boat', [UserRegisterController::class, 'registerYourBoat'])->name('register-your-boat');
    Route::post('/do_register', [UserRegisterController::class, 'register'])->name('do_register');
    Route::get('login', [UserLoginController::class, 'index'])->name('login');
    Route::post('user_login', [UserLoginController::class, 'login'])->name('user_login');
    Route::get('/logout', function () {
        Auth::logout(); 
        return redirect('login'); 
    });

    Route::get('/', [PagesController::class, 'index'])->name('home');
    Route::get('/about-us', [PagesController::class, 'aboutUs'])->name('about-us');
    Route::get('/help', [PagesController::class, 'help'])->name('help');
    Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
    Route::get('/ourfleet', [PagesController::class, 'ourFleet'])->name('ourfleet');
    Route::get('/location', [PagesController::class, 'location'])->name('location');
    Route::get('/boat-rental/search', [PagesController::class, 'search'])->name('search');
    Route::get('/privacy-policy', [PagesController::class, 'PrivacyPolicy'])->name('privacy-policy');
    Route::get('/terms-condition', [PagesController::class, 'terms'])->name('terms-condition');
    Route::get('/blogs', [PagesController::class, 'blog'])->name('blogs');

    Route::get('single/{slug}', [PagesController::class, 'single'])->name('single');
    Route::match(['get', 'post'],'checkout', [PagesController::class, 'checkout'])->name('checkout');
    Route::get('getbookingprice', [PagesController::class, 'getBookingPrice'])->name('getbookingprice');

    Route::prefix('ajax')->name('ajax.')->middleware('ajax')->group(function () {
        Route::get('getregisterboatform', [AjaxController::class, 'getRegisterBoatForm'])->name('getregisterboatform');
    });
});



