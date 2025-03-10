<?php
namespace App\Services\Admin\Setting;

use App\Repositories\Admin\Setting\SettingRepository;

class SettingService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new SettingRepository();
    }
    public function getAllData()
    {
        return $this->repostiry->getAllData();
    }
    public function storeUpdate($request)
    {
        return $this->repostiry->storeUpdate($request);
    }
    public function uploadLogo($request)
    {
        return $this->repostiry->uploadLogo($request);
    }
    public function uploadLogoWhite($request)
    {
        return $this->repostiry->uploadLogoWhite($request);
    }
    public function getAllLanguages()
    {
        return $this->repostiry->getAllLanguages();
    }
    public function storeLanguage($request)
    {
        return $this->repostiry->storeLanguage($request);
    }
    public function editLanguage($id)
    {
        return $this->repostiry->editLanguage($id);
    }
    public function updateLanguage($request,$id)
    {
        return $this->repostiry->updateLanguage($request,$id);
    }
    public function change_status($request)
    {
        return $this->repostiry->change_status($request);
    }
    public function destroyLanguage($id)
    {
        return $this->repostiry->destroyLanguage($id);
    }
}