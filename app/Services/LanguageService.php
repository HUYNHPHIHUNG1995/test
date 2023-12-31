<?php

namespace App\Services;

use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class LanguageService implements LanguageServiceInterface
{
    protected $languageRepository;
    public function __construct(
        LanguageRepository $languageRepository)
    {
        $this->languageRepository=$languageRepository;
    }
    public function paginate($request)
    {;
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['publish']=$request->input('publish');
        $condition['user_catalogue_id']=$request->input('user_catalogue_id');
        $perpage=$request->integer('perpage');
        $language=$this->languageRepository->pagination(['*'],$condition,[],
            ['path'=>'/admin/language/list'],$perpage,[]);
        return $language;
    }

    public function updateStatus($data = [])
    {
        
        DB::beginTransaction();
        try {
            $payload[$data['field']]=(($data['value']==1)?0:1);
            $this->languageRepository->update($data['modelId'],$payload);
            //$this->changUserStatus($data,$payload[$data['field']]);
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
            $flag = $this->languageRepository->updateByWhereIn('id',$data['id'],$payload);
            //$this->changUserStatus($data,$payload[$data['field']]);
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    //neu catalogue bat thi cac user theo cata đó dc bật,ngược lại
    // private function changUserStatus($data,$value){
    //     DB::beginTransaction();
    //     try {
    //         $array=[];
    //         if(isset($data['modelId'])){
    //             $array[]=$data['modelId'];
    //         }else{
    //             $array=$data['id'];
    //         }
    //         $payload[$data['field']]=$value;
    //         $this->userRepository->updateByWhereIn('user_catalogue_id',$array,$payload);
    //         DB::commit();
    //         return true;
    //     }catch (\Exception $e){
    //         DB::rollBack();
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }

    public function create($request)
    {
        //$inputs=$request->except(['_token','send','repassword','active']);
        //dd($inputs['birthday']);die();
        DB::beginTransaction();
        try {
            $inputs=$request->except(['_token','send']);
            //$inputs['deleted_at']=null;
            $inputs['user_id']=Auth::id();//lay id dang dang nhap cho khoa ngoai 
            $this->languageRepository->create($inputs);//userRepository extends BaseRepository
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
            //dd($inputs);die();
            $this->languageRepository->update($id,$inputs);//userRepository extends BaseRepository
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

            $this->languageRepository->delete($id);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
