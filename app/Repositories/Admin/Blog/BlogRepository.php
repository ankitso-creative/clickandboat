<?php
namespace App\Repositories\Admin\Blog;
use App\Models\Admin\Blog;
class BlogRepository
{
    public function allBlogs()
    {
        return Blog::all();
    }
    public function store($request)
    {
        $blog = new Blog();
        $blog->title = $request['title'];
        $blog->description = $request['description'];
        if($blog->save()):
            return true;
        else:
            return false;
        endif;
    }
    public function blogEdit($id)
    {
        return Blog::find($id);
    }
    public function blogUpdate($request,$id)
    {
       $blog = Blog::find($id);
       $blog->title = $request['title'];
       $blog->description = $request['description'];
        if($blog->update()):
            return true;
        else:
            return false;
        endif;
    }
    public function blogDestroy($id)
    {
        $blog = Blog::find($id);
        if($blog->delete()):
            session()->flash('success', 'Blog deleted successfully.');
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
        $blog = Blog::where('id',$id)->first();
        $blog->status = $request['value'];
        $blog->update();
        return $blog;
    }

}