<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    protected $userRepository;
    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository
    )
    {
        $this->userService = $userService;
        $this->provinceRepository=$provinceRepository;
        $this->userRepository=$userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //$list=$this->userService->paginate();
        return view('admin.users.list',[
           'title'=>'Danh sách tài khoản',
            'listUsers'=>$this->userService->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $province=$this->provinceRepository->all();//phuong thuv all dc ke thua tu BaseRepository
        return view('admin.users.add',[
            'title'=>'Thêm mới thành viên',
            'provinces'=>$province,
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        if($this->userService->create($request))
        {
            Session::flash('success','Thêm mới thành công');
            return redirect()->route('createUser');
        }
        Session::flash('error','Lỗi! Thêm mới không thành công');
        return redirect()->route('createUser')->withInput();
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
        $province=$this->provinceRepository->all();
        $userById=$this->userRepository->findById($id);
        return view('admin.users.edit',[
            'title'=>'Sửa thành viên',
            'userById'=>$userById,
            'provinces'=>$province,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        if($this->userService->update($id,$request))
        {
            Session::flash('success','Sửa thành công');
            return redirect()->route('getListUser');
        }
        Session::flash('error','Lỗi! Sửa không thành công');
        return redirect()->route('editUser',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id = 0)
    {
        return $id;
    }
}
