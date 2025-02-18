<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Services\Admin\User\UsersService;
use App\Http\Requests\Admin\Users\StoreUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $service;
    public function __construct()
    {
        $this->service = new UsersService();
    }
    public function index()
    {
        $active = 'manage_users';
        $allBoatOwner = $this->service->getAllBoatOwner();
        return view('admin.users.index',compact('active','allBoatOwner'));
    }
    public function customers()
    {
        $allCustomer = $this->service->getAllCustomer();
        $active = 'manage_users';
        return view('admin.users.customer_details',compact('active','allCustomer'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $active = 'manage_users';
        $options = selectOption('countries','name','id');
        return view('admin.users.add',compact('active','options'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request = $request->all();
        $result = $this->service->store($request);
        if($result):
            if($request['role']=='boatowner'):
                return redirect()->route('admin.boatowner')->with('success', 'Boat owner created successfully!'); 
            else:
                return redirect()->route('admin.customer')->with('success', 'Customer created successfully!'); 
            endif; 
        else:
            session()->flash('error', 'There was an error with your submission.');
            return redirect()->route('admin.users.index');  // or redirect()->back();
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
        $userData = $this->service->editUser($id);
        $active = 'manage_users';
        $options = selectOption('countries','name','id');
        if(isset($userData->profile->country)):
            $options = selectOption('countries','name','id',$userData->profile->country);
        endif;
        return view('admin.users.edit',compact('active','userData','options'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $request = $request->all();
        $result = $this->service->updateUser($id,$request);
        if($result):
            if($request['role']=='boatowner'):
                return redirect()->route('admin.boatowner')->with('success', 'Boat owner updated successfully!'); 
            else:
                return redirect()->route('admin.customer')->with('success', 'Customer updated successfully!');
            endif; 
        else:
            return redirect()->route('admin.users.index')->with('error','There was an error with your submission.');  // or redirect()->back();
        endif;
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       return $this->service->deleteUser($id);
    }
    public function changeStatus(Request $request)
    {
       return $this->service->change_status($request);
    }
}
