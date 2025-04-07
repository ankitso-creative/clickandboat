<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Faq\FaqStoreRequest;
use App\Http\Requests\Admin\Faq\FaqUpdateRequest;
use App\Services\Admin\Faq\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $service;
    public function __construct()
    {
        $this->service = new FaqService;
    }
    public function index(Request $request)
    {
        //$request =  $request->all();
        $results = $this->service->allFaqs($request);
        $languages = selectOption('languages','name','code','',array('status','1'));
        $active = 'faq';
        return view('admin.faq.index',compact('active','results','languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'blog';
        return view('admin.faq.add',compact('active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FaqStoreRequest $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
           return redirect()->route('admin.faq.index')->with('success', 'Faq created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.faq.index');  
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
        $active = 'faq';
        $languages = selectOption('languages','name','code','',array('status','1'));
        $result = $this->service->faqEdit($id);
        return view('admin.faq.edit',compact('active','result','languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FaqUpdateRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->faqUpdate($request,$id);
        if($result):
           return redirect()->route('admin.faq.index')->with('success', 'Faq created successfully!'); 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.faq.index');  
        endif;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $result = $this->service->faqDestroy($id);
    }
    public function changeStatus(Request $request)
    {
       return $this->service->changeStatus($request);
    }
    
}
