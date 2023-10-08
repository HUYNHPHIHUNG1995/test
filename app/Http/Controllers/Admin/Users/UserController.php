<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    protected $userService;
    protected $provinceRepository;
    public function __construct(
        UserService $userService,
        ProvinceRepository $provinceRepository
    )
    {
        $this->userService = $userService;
        $this->provinceRepository=$provinceRepository;
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
        return redirect()->route('createUser');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
