<?php
namespace App\Repositories\Admin\Faq;

use App\Models\Admin\Faq;
use App\Models\Admin\Language;
use App\Repositories\Translator\TranslatorRepository;
class FaqRepository
{
    protected $translate ;
    public function __construct()
    {
        $this->translate = new TranslatorRepository();
    }
    public function allFaqs($request)
    {
        $blog = Faq::when($request->has('question') && !empty($request->question), function ($query) use ($request) {
            $name = $request->question; 
            return $query->where('question', $name); 
        })
        ->paginate(9);
        return $blog;
    }
    public function store($request)
    {
        $faq = new Faq();
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->language = 'en';
        if($faq->save()):
            $languages = Language::where('code','<>','en')->where('status','1')->get();
            if($languages)
            {
                foreach($languages as $language)
                {
                    $translatedFaq = new Faq();
                    $translatedFaq->question = $this->translate->translateContent($request['question'], $language->code);
                    $translatedFaq->answer = $this->translate->translateContent($request['answer'], $language->code);
                    $translatedFaq->language = $language->code;
                    $translatedFaq->group_id = $faq->id;
                    $translatedFaq->save();
                }
            }
            return true;
        else:
            return false;
        endif;
    }
    public function faqEdit($id)
    {
        return Faq::find($id);
    }
    
    public function faqUpdate($request,$id)
    {
        $faq = Faq::find($id);
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        if($faq->update()):
            return true;
        else:
            return false;
        endif;
    }
    public function faqDestroy($id)
    {
        $faq = Faq::find($id);
        if($faq->delete()):
            session()->flash('success', 'Faq deleted successfully.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.blog.index')
            ]);
        else:
            session()->flash('success', 'There was an error deleting the blog. Please try again.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.blog.index')
            ]); 
        endif;
    }
    public function changeStatus($request)
    {
        $id = $request['id'];
        $faq = Faq::where('id',$id)->first();
        $faq->status = $request['value'];
        $faq->update();
        return $faq;
    }
}