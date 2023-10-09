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
        //$inputs=$request->except(['_token','send','repassword','active']);
        //dd($inputs['birthday']);die();
        DB::beginTransaction();
        try {
            $inputs=$request->except(['_token','send','repassword','active']);
            //dd($inputs['birthday']);die();
            if($inputs['birthday'] != '')
            {
                $inputs['birthday']=$this->convertBirthday($inputs['birthday']);
            }else{
                $inputs=$request->except(['_token','send','repassword','active','birthday']);
            }


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

    public function update($id,$request)
    {

        DB::beginTransaction();
        try {
            $inputs=$request->except(['_token','send','active']);
            if($inputs['birthday'] != '')
            {
                $inputs['birthday']=$this->convertBirthday($inputs['birthday']);
            }else{
                $inputs=$request->except(['_token','send','active','birthday']);
            }
            $this->userRepository->update($id,$inputs);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }

    public function convertBirthday($birthday ='')
    {
        $birthday=Carbon::createFromFormat('Y-m-d',$birthday);
        $birthdays=$birthday->format('Y-m-d H:i:s');
        return $birthdays;
    }
}
