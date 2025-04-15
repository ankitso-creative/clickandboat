<?php
namespace App\Repositories\Admin\Blog;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogComment;

class BlogRepository
{
    public function allBlogs($request)
    {
        $blog = Blog::when($request->has('name') && !empty($request->name), function ($query) use ($request) {
            $name = $request->name; 
            return $query->where('title', $name); 
        })
        ->when($request->has('language') && !empty($request->language), function ($query) use ($request) {
            $language = $request->language; 
            return $query->where('language', $language); 
        })
        ->orderBy('order_by', 'ASC')
        ->paginate(9);

        return $blog;
    }
    public function store($request)
    {
        $blog = new Blog();
        $blog->title = $request['title'];
        $blog->description = $request['description'];
        $blog->language = $request['language'];
        if($blog->save()):
            self::uploadImage($request['banner_image'],$blog->id);
            return true;
        else:
            return false;
        endif;
    }
    public function blogEdit($id)
    {
        return Blog::with('media')->find($id);
    }
    public function blogComments($blogId)
    {
        return BlogComment::where('blog_id',$blogId)->get();
    }
    public function blogUpdate($request,$id)
    {
        $blog = Blog::find($id);
        $blog->title = $request['title'];
        $blog->description = $request['description'];
        $blog->language = $request['language'];
        if($blog->update()):
            if(isset($request['banner_image']) && $request['banner_image']) {
                self::uploadImage($request['banner_image'],$blog->id);
            }
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
    public function commentStatus($request)
    {
        $id = $request['id'];
        $blog = BlogComment::where('id',$id)->first();
        $blog->status = $request['value'];
        $blog->update();
        return $blog;
    }
    public function changeOrderBlog($request)
    {
        $id = $request['id'];
        $blog = Blog::where('id',$id)->first();
        $blog->order_by = $request['value'];
        $blog->update();
        return $blog;
    }
    public function uploadImage($request,$id)
    {
        $blog = Blog::find($id);
        if ($blog->hasMedia('blog_image')) {
            $blog->getMedia('blog_image')->each(function ($media) {
                $media->delete();  
            });
        }
        $media = $blog->addMediaFromRequest('banner_image')->toMediaCollection('blog_image','blog_images'); 
        return $media;
    }
}