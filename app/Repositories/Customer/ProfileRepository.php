<?php
    namespace App\Repositories\Customer;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    use App\Models\FavoriteItem;
    class ProfileRepository{
        public function updateProfile($request)
        {
            $userId = auth()->id();
            $user = User::where('id', $userId)->with('profile')->first();
            $user->name = $request['first_name']." ".$request['last_name'];
            $user->phone = $request['phone'];
            $user->update();
            $user->profile()->UpdateOrCreate(['user_id' => $userId],[
                'user_id' => $userId,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'gender' => $request['gender'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
                'postcode' => $request['postcode'],
            ]);
            return redirect()->route('customer.profile')->with('success', 'Profile information updated successfully!'); 
        }
        public function passwordUpdate($request)
        {
            $user = Auth::user();
            $user->password = Hash::make($request['password']); // Hash the new password
            if($user->update()):
                return redirect()->route('customer.profile')->with('success', 'Password updated successfully.');
            else:
                return redirect()->route('customer.profile')->with('error', 'Your password not updated.');
            endif;
        }
        public function uploadImage($request)
        {
            $user = Auth::user();
            if ($user->hasMedia('profile_image')) {
                $user->getMedia('profile_image')->each(function ($media) {
                    $media->delete();  // Delete the old image(s)
                });
            }
            $media = $user->addMediaFromRequest('image')->toMediaCollection('profile_image'); // 'images' is the media collection name
            return response()->json([
                'success' => 'success',
                'imageUrl' => $media->getUrl(),
               
               
            ]);
        }
        public function favouriteItems()
        {
            $userId = auth()->id();
            $items = FavoriteItem::where('user_id', $userId)->with(['listing'])->get();
            return $items;
        }
    }

?>