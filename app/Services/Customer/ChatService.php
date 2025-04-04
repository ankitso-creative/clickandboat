<?php 
namespace App\Services\Customer;
use App\Repositories\Customer\ChatRepository;
class ChatService {
    protected $repository;
    public function __construct()
    {
        $this->repository = new ChatRepository();
    }
    public function sendMessage($request)
    {
        return $this->repository->sendMessage($request);
    }
    public function seeAllMessage($request)
    {
        return $this->repository->seeAllMessage($request);
    }
    public function fetchMessages($receiver_id)
    {
        return $this->repository->fetchMessages($receiver_id);
    }
}