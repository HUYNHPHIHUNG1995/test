<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserCatalogueRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use Illuminate\Support\Facades\Session;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;
    public function __construct(
        UserCatalogueService $userCatalogueService,
        UserCatalogueRepository $userCatalogueRepository
    )
    {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository=$userCatalogueRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //$list=$this->userService->paginate();
        return view('admin.user.catalogue.index',[
           'title'=>'Danh sách nhóm thành viên',
           'model'=>'UserCatalogue',
            'userCatalogues'=>$this->userCatalogueService->paginate($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.catalogue.store',[
            'title'=>'Thêm mới nhóm'
        ]);
    }

    public function store(StoreUserCatalogueRequest $request)
    {
        if($this->userCatalogueService->create($request))
        {
            Session::flash('success','Thêm mới thành công');
            return redirect()->route('createCatalogueUser');
        }
        Session::flash('error','Lỗi! Thêm mới không thành công');
        return redirect()->route('createCatalogueUser')->withInput();
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
        $userCatalogueById=$this->userCatalogueRepository->findById($id);
        return view('admin.user.catalogue.update',[
            'title'=>'Sửa thành viên',
            'userCatalogue'=>$userCatalogueById
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserCatalogueRequest $request, string $id)
    {
        if($this->userCatalogueService->update($id,$request))
        {
            Session::flash('success','Sửa thành công');
            return redirect()->route('getListCatalogueUser');
        }
        Session::flash('error','Lỗi! Sửa không thành công');
        return redirect()->route('editCatalogueUser',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->input('getId');
        if($this->userCatalogueService->delete($id))
        {
            Session::flash('success','Xóa thành công');
            return redirect()->route('getListCatalogueUser');
        }
        Session::flash('error','Lỗi! Xóa không thành công');
        return redirect()->route('getListCatalogueUser');
    }
}
