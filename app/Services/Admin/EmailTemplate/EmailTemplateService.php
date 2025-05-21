<?php
namespace App\Services\Admin\EmailTemplate;

use App\Repositories\Admin\EmailTemplate\EmailTemplateRepository;

class EmailTemplateService{

    protected $repostiry;
    public function __construct()
    {
        $this->repostiry = new EmailTemplateRepository();
    }
    public function allEmailTemplates()
    {
        return $this->repostiry->allEmailTemplates();
    }
    public function store($request)
    {
        return $this->repostiry->store($request);
    }
    public function edit($id)
    {
        return $this->repostiry->edit($id);
    }
    public function emailTemplateUpdate($request,$id)
    {
        return $this->repostiry->emailTemplateUpdate($request,$id);
    }
    
    
}