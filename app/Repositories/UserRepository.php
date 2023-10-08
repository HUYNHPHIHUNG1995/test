<?php


namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
       $this->model=$model;
    }

    public function getAllPaginate()
    {
        // TODO: Implement getAllPaginate() method.
        return User::orderByDesc('id')->paginate(20);
    }
}
