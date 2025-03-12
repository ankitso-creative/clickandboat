<?php
    namespace App\Repositories\BoatOwner;
    use App\Models\User;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Auth;
    class ProfileRepository{
        public function updateProfile($request)
        {
            $userId = auth()->id();
            $user = User::where('id', $userId)->with('profile')->first();
            $user->name = $request['first_name']." ".$request['last_name'];
            $user->update();
            $user->profile()->UpdateOrCreate(['user_id' => $userId],[
                'user_id' => $userId,
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'gender' => $request['gender'],
                'dob' => $request['dob'],
                'phone' => $request['phone'],
                'address' => $request['address'],
                'address_line_two' => $request['address_line_two'],
                'city' => $request['city'],
                'state' => $request['state'],
                'country' => $request['country'],
                'postcode' => $request['postcode'],
            ]);
            return redirect()->route('boatowner.profile')->with('success', 'Profile information updated successfully!'); 
        }
        public function passwordUpdate($request)
        {
            $user = Auth::user();
            $user->password = Hash::make($request['password']); // Hash the new password
            if($user->update()):
                return redirect()->route('boatowner.profile')->with('success', 'Password updated successfully.');
            else:
                return redirect()->route('boatowner.profile')->with('error', 'Your password not updated.');
            endif;
        }
        public function experienceUpdate($request)
        {
            $user = Auth::user();
            $userId = auth()->id();
            $user->exprience()->UpdateOrCreate(['user_id' => $userId],[
                'user_id' => $userId,
                'level' => $request['level'],
                'prefer' => $request['prefer'],
                'boat_licence' => isset($request['boat_licence']) ? json_encode($request['boat_licence']) : '', 
                'other' => isset($request['other']) ? json_encode($request['other']) : '',  
                'sailing_experience' => isset($request['sailing_experience']) ? json_encode($request['sailing_experience']) : '',
                'description' => $request['description'],
            ]);
            return redirect()->route('boatowner.profile')->with('success', 'Profile information updated successfully!'); 
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
        public function accountDelete($request)
        {
            $user = Auth::user();
            $user->deleted = $request['delete'];
            if($user->update()):
                Auth::guard("web")->logout(); 
                return redirect()->route('login')->with('success', 'Your account deleted successfully.');
            else:
                return redirect()->route('boatowner.profile')->with('error', 'Please try again.');
            endif;
        }
    }

?>