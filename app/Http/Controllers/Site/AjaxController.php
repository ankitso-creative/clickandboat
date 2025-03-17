<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Front\AjaxService;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new AjaxService();
    }
    public function getRegisterBoatForm()
    {
        dd('sadsa');
    }
    public function favorited(Request $request)
    {
       return $this->service->favorited($request);
    }
}
