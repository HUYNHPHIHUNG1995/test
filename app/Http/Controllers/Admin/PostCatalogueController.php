<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\UpdateLanguagesRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\Session;

class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRepository;
    public function __construct(
        PostCatalogueService $postCatalogueService,
        PostCatalogueRepository $postCatalogueRepository
    )
    {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRepository=$postCatalogueRepository;
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
            'listPostCatalogues'=>$this->postCatalogueService->paginate($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.catalogue.add',[
            'title'=>'Thêm mới nhóm bài viết'
        ]);
    }

    public function store(StoreLanguagesRequest $request)
    {
        if($this->postCatalogueService->create($request))
        {
            Session::flash('success','Thêm mới thành công');
            return redirect()->route('createLanguage');
        }
        Session::flash('error','Lỗi! Thêm mới không thành công');
        return redirect()->route('createLanguage')->withInput();
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
        $postCatalogueById=$this->postCatalogueRepository->findById($id);
        return view('admin.language.edit',[
            'title'=>'Sửa thành viên',
            'languageById'=>$postCatalogueById
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguagesRequest $request, string $id)
    {
        if($this->postCatalogueService->update($id,$request))
        {
            Session::flash('success','Sửa thành công');
            return redirect()->route('getListLanguage');
        }
        Session::flash('error','Lỗi! Sửa không thành công');
        return redirect()->route('editLanguage',$id);
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
