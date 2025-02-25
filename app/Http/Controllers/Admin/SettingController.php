<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Language\LanguageStoreRequest;
use App\Services\Admin\Setting\SettingService;
use Illuminate\Foundation\Console\LangPublishCommand;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new SettingService();
    }
    public function index()
    {
        $results = $this->service->getAllData();
        $active = 'settings';
        return view('admin.setting.details', compact('active','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeUpdate(Request $request)
    {
        $request = $request->all();
        return $this->service->storeUpdate($request);
    }
    public function uploadLogo(Request $request)
    {
        $request = $request->all();
        return $this->service->uploadLogo($request);
    }
    public function uploadLogoWhite(Request $request)
    {
        $request = $request->all();
        return $this->service->uploadLogoWhite($request);
    }
    public function getLanguages()
    {
        $languages = $this->service->getAllLanguages();
        $active = 'settings';
        return view('admin.setting.languages', compact('active','languages'));
    }
    /**
     * Display the specified resource.
     */
    public function addLanguage()
    {
        $active = 'settings';
        return view('admin.setting.add', compact('active'));
    }
    public function storeLanguage(LanguageStoreRequest $request)
    {
        $request = $request->all();
        $results = $this->service->storeLanguage($request);
        if($results):
           return redirect()->route('admin.languages')->with('success', 'Language added successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.languages');  
        endif;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
