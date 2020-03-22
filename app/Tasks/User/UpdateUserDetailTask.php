<?php


namespace App\Tasks\User;


use App\Repositories\UserRepository;
use App\User;
use Exception;

class UpdateUserDetailTask
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct()
    {
        $this->repository = UserRepository::getInstance();
    }

    /**
     * @param User $user
     * @param $input
     * @return int
     */
    public function update(User $user, $input)
    {
        try {
            return $this->repository->updateDetail($user, $input);
        }catch (Exception $exception){
//            throw ;
        }
    }
}
