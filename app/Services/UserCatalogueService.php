<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userRepository;
    public function __construct(
        UserCatalogueRepository $userCatalogueRepository,
        UserRepository $userRepository)
    {
        $this->userCatalogueRepository=$userCatalogueRepository;
        $this->userRepository=$userRepository;
    }
    public function paginate($request)
    {
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['publish']=$request->input('publish');
        $condition['user_catalogue_id']=$request->input('user_catalogue_id');
        $perpage=$request->integer('perpage');
        $userCatalogue=$this->userCatalogueRepository->pagination(['*'],$condition,[],
            ['path'=>'/admin/user/catalogue/list'],$perpage,['users']);
        return $userCatalogue;
    }

    public function updateStatus($data = [])
    {
        
        DB::beginTransaction();
        try {
            $payload[$data['field']]=(($data['value']==1)?0:1);
            $this->userCatalogueRepository->update($data['modelId'],$payload);
            $this->changUserStatus($data,$payload[$data['field']]);
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
            $flag = $this->userCatalogueRepository->updateByWhereIn('id',$data['id'],$payload);
            $this->changUserStatus($data,$payload[$data['field']]);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    //neu catalogue bat thi cac user theo cata đó dc bật,ngược lại
    private function changUserStatus($data,$value){
        DB::beginTransaction();
        try {
            $array=[];
            if(isset($data['modelId'])){
                $array[]=$data['modelId'];
            }else{
                $array=$data['id'];
            }
            $payload[$data['field']]=$value;
            $this->userRepository->updateByWhereIn('user_catalogue_id',$array,$payload);
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
            $inputs=$request->except(['_token','send']);
            $this->userCatalogueRepository->create($inputs);//userRepository extends BaseRepository
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
            $this->userCatalogueRepository->update($id,$inputs);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }

    }
    public function delete($id)
    {
        DB::beginTransaction();
        try {

            $this->userCatalogueRepository->delete($id);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
