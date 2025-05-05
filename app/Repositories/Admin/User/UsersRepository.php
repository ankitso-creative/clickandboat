<?php
namespace App\Repositories\Admin\User;
use App\Models\User;
use App\Models\UserDetail;

class UsersRepository{
    public function getAllBoatOwner()
    {
        return User::where('role', 'boatowner')->with('profile')->paginate(10);
        
    }
    public function getAllCustomer()
    {
        return User::where('role', 'customer')->with('profile')->paginate(10);
        
    }
    public function store($request)
    {
        $user = new User();
        $user->name = $request['first_name']." ".$request['last_name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        $user->password = $request['password'];
        $user->save();
        $userId = $user->id;
        if($userId):
            $profile = new UserDetail();
            $profile->user_id = $userId;
            $profile->first_name = $request['first_name'];
            $profile->last_name = $request['last_name'];
            $profile->gender = $request['gender'];
            $profile->dob = $request['dob'];
            $profile->phone = $request['phone'];
            $profile->address = $request['address'];
            $profile->address_line_two = $request['address_two'];
            $profile->city = $request['city'];
            $profile->state = $request['state'];
            $profile->country = $request['country'];
            $profile->postcode = $request['post_code'];
            $profile->save();
            if($profile->id):
                return $userId;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }
    public function editUser($id)
    {
        return User::where('id', $id)->with('profile')->first();
    }
    public function updateUser($id,$request)
    {
        $user = User::where('id', $id)->with('profile')->first();
        $user->name = $request['first_name']." ".$request['last_name'];
        $user->email = $request['email'];
        $user->role = $request['role'];
        if($request['password']):
            $user->password = $request['password'];
        endif;
        $user->update();
        $user->profile()->UpdateOrCreate(['user_id' => $user->id],[
            'user_id' => $user->id,
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'gender' => $request['gender'],
            'dob' => $request['dob'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'address_line_two' => $request['address_two'],
            'city' => $request['city'],
            'state' => $request['state'],
            'country' => $request['country'],
            'postcode' => $request['post_code'],
        ]);
        return true;
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $role = $user->role;
        $user->delete();  
        $user->profile()->delete(); 
        if($role):
            if($role=='boatowner'):
                session()->flash('success', 'Boatowner deleted successfully.');
                return response()->json([
                    'success' => true, 
                    'url' =>route('admin.boatowner')
                ]);
            else:
                session()->flash('success', 'Customer deleted successfully.');
                return response()->json([
                    'success' => true, 
                    'url' =>route('admin.customer')
                ]);
            endif; 
        else:
            session()->flash('success', 'There was an error deleting the user. Please try again.');
            if($role=='boatowner'):
                return response()->json([
                    'success' => true, 
                    'url' =>route('admin.boatowner')
                ]); 
            else:
                return response()->json([
                    'success' => true, 
                    'url' =>route('admin.customer')
                ]);
            endif;
        endif;
    }
    public function change_status($request)
    {
        $id = $request['id'];
        $user = User::where('id',$id)->first();
        $user->status = $request['value'];
        $user->update();
        return $user;
    }
}