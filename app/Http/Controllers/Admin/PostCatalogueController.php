<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Http\Requests\UpdatePostCatalogueRequest;
use App\Classes\Nestedsetbie;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\Session;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    protected $nestedset;
    protected $language;
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository
    )
    {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository=$postCatalogueRepository;
        $this->nestedset=new Nestedsetbie([
            'table'=>'post_catalogues',
            'foreignkey'=>'post_catalogue_id',
            'language_id'=>1
        ]);
        $this->language=$this->currentLanguage();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //$list=$this->userService->paginate();
        return view('admin.post.catalogue.index',[
           'title'=>'Danh sách nhóm bài viết',
           'model'=>'PostCatalogue',
            'postCatalogues'=>$this->postCatalogueService->paginate($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dropdown=$this->nestedset->Dropdown();
        $config['seo']=config('apps.postcatalogue');
        $config['method']='create';
        return view('admin.post.catalogue.store',[
            'title'=>'Thêm mới nhóm bài viết',
            'config'=>'create',
            'dropdown'=>$dropdown,
            'config'=>$config
        ]);
    }

    public function store(StorePostCatalogueRequest $request)
    {
        if($this->postCatalogueService->create($request))
        {
            Session::flash('success','Thêm mới thành công');
            return redirect()->route('getListPostCatalogue');
        }
        Session::flash('error','Lỗi! Thêm mới không thành công');
        return redirect()->route('createPostCatalogue')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $postCatalogueById=$this->postCatalogueRepository->getPostCatalogueById($id,$this->language);
        $dropdown=$this->nestedset->Dropdown();
        $config['seo']=config('apps.postcatalogue');
        $config['method']='edit';
        return view('admin.post.catalogue.store',[
            'title'=>'Sửa bài viết',
            'config'=>'update',
            'postCatalogue'=>$postCatalogueById,
            'dropdown'=>$dropdown,
            'config'=>$config
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCatalogueRequest $request, string $id)
    {
        if($this->postCatalogueService->update($id,$request))
        {
            Session::flash('success','Sửa thành công');
            return redirect()->route('getListPostCatalogue');
        }
        Session::flash('error','Lỗi! Sửa không thành công');
        return redirect()->route('editPostCatalogue',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->input('getId');
        if($id!=null && $this->postCatalogueService->delete($id))
        {
            Session::flash('success','Xóa thành công');
            return redirect()->route('getListLanguage');
        }
        Session::flash('error','Lỗi! Xóa không thành công');
        return redirect()->route('getListLanguage');
    }
}
