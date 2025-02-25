<?php
namespace App\Repositories\Admin\Setting;

use App\Models\Admin\Language;
use App\Models\Admin\Setting;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Storage;

class SettingRepository{
    public function getAllData()
    {
        $results =  Setting::all();
        $data = [];
        if($results):
            foreach($results as $result):
                $data[$result->meta_key] = $result->meta_value;
                if($result->hasMedia('logo')):
                    $logo = $result->getFirstMedia('logo');
                    $data['logo'] =  $logo->getUrl() ?? '';
                endif;
                if($result->hasMedia('logo-white')):
                    $logo = $result->getFirstMedia('logo-white');
                    $data['logo-white'] =  $logo->getUrl() ?? '';
                endif;
            endforeach;
        endif;
        //dd($data);
        return $data;
    }
    public function storeUpdate($request)
    {
        if($request['setting']):
            foreach($request['setting'] as $settingKey => $settingValue):
                $setting = Setting::updateOrCreate(
                    ['meta_key' => $settingKey],
                    ['meta_value' => $settingValue ?? '']
                );
            endforeach;
        endif;
        return redirect()->route('admin.settings.index')->with('success', 'Your setting details saved successfully!'); 
    }
    public function uploadLogo($request)
    {
        $setting = Setting::first();
        if ($setting->hasMedia('image')) {
            $setting->getMedia('image')->each(function ($media) {
                $media->delete();
            });
        }
        $media = $setting->addMediaFromRequest('image')->toMediaCollection('logo', 'website_logo'); 
        return response()->json([
            'success' => 'success',
            'message' => 'Logo uploaded successfully.',
            'imageUrl' => $media->getUrl()
        ]);
    }
    public function uploadLogoWhite($request)
    {
        $setting = Setting::first();
        if($setting->hasMedia('logo-white')) {
            $setting->getMedia('logo-white')->each(function ($media) {
                $media->delete();
            });
        }
        $media = $setting->addMediaFromRequest('image-white')->toMediaCollection('logo-white', 'website_logo'); 
        return response()->json([
            'success' => 'success',
            'message' => 'Logo uploaded successfully.',
            'imageUrl' => $media->getUrl()
        ]);
    }
    public function getAllLanguages()
    {
        return Language::all();
    }
    public function storeLanguage($request)
    {
        $language = new Language();
        $language->name = $request['name'];
        $language->code = $request['code'];
        if($language->save()):
            return true;
        else:
            return false;
        endif;
    }
}