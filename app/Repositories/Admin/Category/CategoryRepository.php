<?php
namespace App\Repositories\Admin\Category;

use App\Models\Admin\Category;

class CategoryRepository
{
    public function allCategory()
    {
        $category = Category::all();
        return $category;
    }
    public function store($request)
    {
        $category = new Category();
        $category->name = $request['name'];
       
        if($category->save()):
            self::uploadImage($request['image'],$category->id);
            self::uploadIcon($request['icon'],$category->id);
            return true;
        else:
            return false;
        endif;
    }
    public function categoryEdit($id)
    {
        return Category::with('media')->find($id);
    }
   
    public function categoryUpdate($request,$id)
    {
        $category = Category::find($id);
        $category->name = $request['name'];
        
        if($category->update()):
            if(isset($request['image']) && $request['image']) {
                self::uploadImage($request['image'],$category->id);
            }
            if(isset($request['icon']) && $request['icon']) {
                self::uploadIcon($request['icon'],$category->id);
            }
            return true;
        else:
            return false;
        endif;
    }
    public function categoryDestroy($id)
    {
        $category = Category::find($id);
        if($category->delete()):
            session()->flash('success', 'Category deleted successfully.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.category.index')
            ]);
        else:
            session()->flash('success', 'There was an error deleting the category. Please try again.');
            return response()->json([
                'success' => true, 
                'url' =>route('admin.category.index')
            ]); 
        endif;
    }
    public function changeStatus($request)
    {
        $id = $request['id'];
        $category = Category::where('id',$id)->first();
        $category->status = $request['value'];
        $category->update();
        return $category;
    }
    public function uploadImage($request,$id)
    {
        $category = Category::find($id);
        if ($category->hasMedia('category_image')) {
            $category->getMedia('category_image')->each(function ($media) {
                $media->delete();  
            });
        }
        $media = $category->addMediaFromRequest('image')->toMediaCollection('category_image','listing'); 
        return $media;
    }
    public function uploadIcon($request,$id)
    {
        $category = Category::find($id);
        if ($category->hasMedia('category_icon')) {
            $category->getMedia('category_icon')->each(function ($media) {
                $media->delete();  
            });
        }
        $media = $category->addMediaFromRequest('icon')->toMediaCollection('category_icon','listing'); 
        return $media;
    }
}