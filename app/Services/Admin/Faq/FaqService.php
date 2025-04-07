<?php
namespace App\Services\Admin\Faq;

use App\Repositories\Admin\Faq\FaqRepository;

class FaqService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new FaqRepository();
    }
    public function allFaqs($request)
    {
        return $this->repostiry->allFaqs($request);
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function faqEdit($id)
    {
        return $this->repostiry->faqEdit($id);
    }
    public function faqUpdate($request,$id)
    {
        return $this->repostiry->faqUpdate($request,$id);
    }
    public function faqDestroy($id)
    {
        return $this->repostiry->faqDestroy($id);
    }
    public function changeStatus($id)
    {
        return $this->repostiry->changeStatus($id);
    }
    
}