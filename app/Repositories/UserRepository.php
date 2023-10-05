<?php


namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAllPaginate()
    {
        // TODO: Implement getAllPaginate() method.
        return User::orderByDesc('id')->paginate(20);
    }
}
