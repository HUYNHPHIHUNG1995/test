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
    public function paginate($request)
    {
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['publish']=$request->input('publish');
        
        $condition['user_catalogue_id']=$request->input('user_catalogue_id');
        $perpage=$request->integer('perpage');
        $user=$this->userRepository->pagination(['*'],$condition,[],
            ['path'=>'/admin/user/list'],$perpage,[],[]);
        return $user;
    }

    public function updateStatus($data = [])
    {
        
        DB::beginTransaction();
        try {
            $payload[$data['field']]=(($data['value']==1)?0:1);
            $this->userRepository->update($data['modelId'],$payload);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function updateAllStatus($data=[]){
        DB::beginTransaction();
        try {
            $payload[$data['field']]=$data['value'];
            $flag = $this->userRepository->updateByWhereIn('id',$data['id'],$payload);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function create($request)
    {
        //$inputs=$request->except(['_token','send','repassword','active']);
        //dd($inputs['birthday']);die();
        DB::beginTransaction();
        try {
            $inputs=$request->except(['_token','send','repassword']);
            //dd($inputs['birthday']);die();
            if($inputs['birthday'] != '')
            {
                $inputs['birthday']=$this->convertBirthday($inputs['birthday']);
            }else{
                $inputs=$request->except(['_token','send','repassword','birthday']);
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
            $inputs=$request->except(['_token','send']);
            if($inputs['birthday'] != '')
            {
                $inputs['birthday']=$this->convertBirthday($inputs['birthday']);
            }else{
                $inputs=$request->except(['_token','send','birthday']);
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

    public function delete($id)
    {
        DB::beginTransaction();
        try {

            $this->userRepository->delete($id);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
