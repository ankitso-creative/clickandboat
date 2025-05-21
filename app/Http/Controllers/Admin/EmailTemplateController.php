<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\Faq\EmailTemplateUpdateRequest;
use App\Services\Admin\EmailTemplate\EmailTemplateService;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new EmailTemplateService;
    }
    public function index(Request $request)
    {
        $results = $this->service->allEmailTemplates();
        $active = 'templates';
        return view('admin.emailstemplate.index',compact('active','results'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'templates';
        return view('admin.emailstemplate.add',compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
           return redirect()->route('admin.emailtemplate.index')->with('success', 'Email Template created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.emailtemplate.index');  
        endif;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $active = 'templates';
        $languages = selectOption('languages','name','code','',array('status','1'));
        $result = $this->service->edit($id);
        return view('admin.emailstemplate.edit',compact('active','result','languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmailTemplateUpdateRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->emailTemplateUpdate($request,$id);
        if($result):
           return redirect()->route('admin.emailtemplate.index')->with('success', 'Email Template updated successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.emailtemplate.index');  
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function changeStatus(Request $request)
    {
       //
    }
    
}
