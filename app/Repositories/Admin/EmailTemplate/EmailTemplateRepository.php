<?php
namespace App\Repositories\Admin\EmailTemplate;

use App\Models\EmailTemplate;

class EmailTemplateRepository
{
    public function allEmailTemplates()
    {
        $blog = EmailTemplate::paginate(9);
        return $blog;
    }
    public function store($request)
    {
        $emailTemplate = new EmailTemplate();
        $emailTemplate->title = $request['title'];
        $emailTemplate->subject = $request['subject'];
        $emailTemplate->description = $request['description'];
        $emailTemplate->who_receive = $request['who_receive'];
        if($emailTemplate->save()):
            return true;
        else:
            return false;
        endif;
    }
    public function edit($id)
    {
        return EmailTemplate::find($id);
    }
    
    public function emailTemplateUpdate($request,$id)
    {
        $emailTemplate = EmailTemplate::find($id);
        $emailTemplate->subject = $request['subject'];
        $emailTemplate->description = $request['description'];
        $emailTemplate->who_receive = $request['who_receive'];
        if($emailTemplate->update()):
            return true;
        else:
            return false;
        endif;
    }
    
   
}