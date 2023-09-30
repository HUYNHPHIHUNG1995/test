<?php


namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterfaces;

class UserRepository implements UserRepositoryInterfaces
{
    public function getAllPaginate()
    {
        // TODO: Implement getAllPaginate() method.
        return User::orderByDesc('id')->paginate(20);
    }
}
