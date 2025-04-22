<?php

namespace App\Http\Controllers\BoatOwner;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoatOwner\Profile\CompanyRequest;
use App\Http\Requests\BoatOwner\Profile\ProfileRequest;
use App\Http\Requests\BoatOwner\Profile\PasswordRequest;
use App\Http\Requests\BoatOwner\Profile\ExperienceRequest;
use App\Http\Requests\BoatOwner\Profile\UploadImageRequest;
use App\Models\Country;
use App\Models\UserExprience;
use Illuminate\Http\Request;
use App\Services\BoatOwner\ProfileService;
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
        $userData = auth()->user()->load(['profile','media','exprience']);
        $options = selectOption('countries','name','id');
        if(isset($userData->profile->country)):
            $options = selectOption('countries','name','id',$userData->profile->country);
        endif;
        $active = 'profile';
        $exists = UserExprience::where('user_id', $userData->id)->exists();
        return view('boatowner.profile',compact('active','options','userData','exists'));
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
    public function experienceUpdate(ExperienceRequest $request)
    {
        $request = $request->all();
        return $this->service->experienceUpdate($request);
    }
    public function companyUpdate(CompanyRequest $request)
    {
        $request = $request->all();
        return $this->service->companyUpdate($request);
    }
    public function accountDelete(Request $request)
    {
        return $this->service->accountDelete($request);
    }
    public function uploadImage(UploadImageRequest $request)
    {
        $request = $request->all();
        return $this->service->uploadImage($request);
    }
}
