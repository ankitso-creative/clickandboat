<?php
    namespace App\Repositories\Front;
    use Illuminate\Support\Facades\Session;
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
    }