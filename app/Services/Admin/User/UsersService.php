<?php
namespace App\Services\Admin\User;

use App\Events\Admin\UserChangeStatus;
use App\Repositories\Admin\User\UsersRepository;
class UsersService{
    protected $repository;
    public function __construct()
    {
        $this->repository = new UsersRepository();
    }
    public function store($request)
    {
        return $this->repository->store($request);

    }
    public function getAllBoatOwner()
    {
        return $this->repository->getAllBoatOwner();

    }
    public function getAllCustomer()
    {
        return $this->repository->getAllCustomer();

    }
    public function editUser($id)
    {
        return $this->repository->editUser($id);

    }
    public function updateUser($id,$request)
    {
        return $this->repository->updateUser($id,$request);

    }
    public function deleteUser($id)
    {
        return $this->repository->deleteUser($id);

    }
    public function changeSuper($id)
    {
        return $this->repository->changeSuper($id);
    }
    public function change_status($request)
    {
        $user =  $this->repository->change_status($request);
        if($user->role == 'boatowner'):
            event(new UserChangeStatus($user));
        endif;
        return true;
    }
}