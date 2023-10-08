<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository=$userRepository;
    }
    public function paginate()
    {
        $user=$this->userRepository->getAllPaginate();
        return $user;
    }

    public function create($request)
    {

        DB::beginTransaction();
        try {
            $inputs=$request->except(['_token','send','repassword','active']);
            $birthday=Carbon::createFromFormat('Y-m-d',$inputs['birthday']);
            $inputs['birthday']=$birthday->format('Y-m-d H:i:s');
            $inputs['password']=Hash::make($inputs['password']);
            $this->userRepository->create($inputs);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }
}
