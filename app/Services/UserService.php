<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function __construct()
    {

    }
    public function paginate()
    {
        return User::orderByDesc('id')->paginate(20);
    }
}
