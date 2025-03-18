<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\ProfileRequest;
use App\Http\Requests\Customer\Profile\PasswordRequest;
use App\Http\Requests\Customer\Profile\UploadImageRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Services\Customer\ProfileService;
use Auth;
class ProfileController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new ProfileService();
    }
    public function index()
    {
        $userData = auth()->user()->load(['profile','media']);
        $options = selectOption('countries','name','id');
        if(isset($userData->profile->country)):
            $options = selectOption('countries','name','id',$userData->profile->country);
        endif;
        $active = 'profile';
        return view('customer.profile',compact('active','options','userData'));
    }
    public function favourite()
    {
        $active = 'favourite';
        $results = $this->service->favouriteItems();
        return view('customer.favourite',compact('active','results'));
    }
    public function update(ProfileRequest $request)
    {
        $request = $request->all();
        return $this->service->updateProfile($request);
    }
    public function passwordUpdate(PasswordRequest $request)
    {
        $request = $request->all();
        return $this->service->passwordUpdate($request);
    }
    public function uploadImage(UploadImageRequest $request)
    {
        $request = $request->all();
        return $this->service->uploadImage($request);
    }
}
