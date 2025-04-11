<?php
    namespace App\Repositories\Front;

    use App\Events\Front\AddFavorite;
    use App\Models\Admin\Blog;
    use App\Models\Admin\BlogComment;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Cookie;
    use App\Models\FavoriteItem;
    class AjaxRepository
    {
        public function favorited($request)
        {
            $item = new FavoriteItem();
            $user = auth()->user();
            $isFavorited = $user->favoriteitems()->where('listing_id', $request->item_id)->exists();
            if(!$isFavorited)
            {
                $item->user_id = $user->id;
                $item->listing_id =$request->item_id;
                if($item->save())
                {
                   // event(new AddFavorite($item));
                    return response()->json([
                        'success' => 'success',
                        'action' => 'save',
                    ]);
                }
                else
                {
                    return response()->json([
                        'success' => 'error',
                        'message' => 'Item is not in favorites',
                    ]);
                }
            }
            else
            {
                $favoriteItem = $user->favoriteitems()->where('listing_id', $request->item_id)->first();
                if($favoriteItem->delete())
                {
                    return response()->json([
                        'success' => 'success',
                        'action' => 'delete',
                    ]);
                }
                else
                {
                    return response()->json([
                        'success' => 'error',
                        'message' => 'Item is not in favorites',
                    ]);
                }
            }
        }
        public function storePostComment($request)
        {
            $blogComment = new BlogComment();
            $blogId = Blog::where('slug', $request["slug"])->pluck('id')->first();
            $blogComment->blog_id = $blogId;
            $blogComment->message = $request["comment"];
            $blogComment->name = $request["name"];
            $blogComment->email = $request["email"];
            $blogComment->website = $request["website"];
            if(isset($request["wp-comment-cookies-consent"]) && !empty($request["wp-comment-cookies-consent"]))
            {
                $data = [
                    'name' => $request["name"],
                    'email' => $request["email"],
                ];
                $cookie = cookie('user_data', serialize($data), 43200);
            }
            if( $blogComment->save())
            {
                return response()->json([
                    'success' => 'success',
                    'message' => 'Your comment has been saved successfully. Please wait for admin approval.',
                    'alert_class' => 'alert-success',
                ]);
            }
            else
            {
                return response()->json([
                    'success' => 'error',
                    'alert_class' => 'alert-danger',
                    'message' => 'Your comment could not be saved. Please try again later.',
                ]);
            }
        }
    }