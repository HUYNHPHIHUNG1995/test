<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\BaseService;
use App\Classes\Nestedsetbie;

/**
 * Class UserService
 * @package App\Services
 */
class PostCatalogueService extends BaseService implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    protected $nestedset;
    protected $language;
    public function __construct(
        PostCatalogueRepository $postCatalogueRepository
    )
    {
        $this->postCatalogueRepository=$postCatalogueRepository;
        $this->language=$this->currentLanguage();
        $this->nestedset=new Nestedsetbie([
            'table'=>'post_catalogues',
            'foreignkey'=>'post_catalogue_id',
            'language_id'=>$this->language,
        ]);
    }
    public function paginate($request)
    {;
        $condition['keyword']=addslashes($request->input('keyword'));
        $condition['publish']=$request->input('publish');
        $condition['user_catalogue_id']=$request->input('user_catalogue_id');
        $perpage=$request->integer('perpage');
        $condition['where'] =[
                                ['tb2.language_id', '=', $this->language]
                            ];
        $postCatalogue=$this->postCatalogueRepository->pagination(
            $this->paginateSelect(),
            $condition,
            [
                ['post_catalogue_language as tb2','tb2.post_catalogue_id', '=' , 'post_catalogues.id']
            ],
            ['path'=>'/admin/post/catalogue/list'],
            $perpage,
            [],
            ['post_catalogues.lft','ASC']
        );
        return $postCatalogue;
    }

    public function updateStatus($data = [])
    {
        
        DB::beginTransaction();
        try {
            $payload[$data['field']]=(($data['value']==1)?0:1);
            $this->postCatalogueRepository->update($data['modelId'],$payload);
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
            $flag = $this->postCatalogueRepository->updateByWhereIn('id',$data['id'],$payload);
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
            $inputs=$request->only($this->payload());
            //$inputs['deleted_at']=null;
            $inputs['user_id']=Auth::id();//lay id dang dang nhap cho khoa ngoai 
            $postCatalogue=$this->postCatalogueRepository->create($inputs);//userRepository extends BaseRepository
            if($postCatalogue->id >0){
                $inputsLanguages=$request->only($this->payloadLanguage());
                $inputsLanguages['language_id']=$this->currentLanguage();
                $inputsLanguages['post_catalogue_id']=$postCatalogue->id;
                $language=$this->postCatalogueRepository->createLanguagePivot($postCatalogue,$inputsLanguages);
            }
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0,$this->nestedset->Set());
            $this->nestedset->Action();
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
            $postCatalogue=$this->postCatalogueRepository->findById($id);
            $payload=$request->only($this->payload());
            //dd($inputs);die();
            $flag=$this->postCatalogueRepository->update($id,$payload);
            if($flag==TRUE){
                $payloadLanguages=$request->only($this->payloadLanguage());
                $payloadLanguages['language_id']=$this->currentLanguage();
                $payloadLanguages['post_catalogue_id']=$id;
                $postCatalogue->languages()->detach($payloadLanguages['language_id'],$id);
                $respone=$this->postCatalogueRepository->createLanguagePivot($postCatalogue,$payloadLanguages);
                $this->nestedset->Get('level ASC, order ASC');
                $this->nestedset->Recursive(0,$this->nestedset->Set());
                $this->nestedset->Action();
            }
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

            $this->postCatalogueRepository->delete($id);//userRepository extends BaseRepository
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }


    private function paginateSelect(){
        return [
            'post_catalogues.id', 
            'post_catalogues.publish',
            'post_catalogues.image',
            'post_catalogues.level',
            'post_catalogues.order',
            'tb2.name', 
            'tb2.canonical',
        ];
    }

    private function payload(){
        return [
            'parent_id',
            'follow',
            'publish',
            'image',
            'album',
        ];
    }
    private function payloadLanguage(){
        return [
            'name',
            'description',
            'content',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'canonical'
        ];
    }
}
