<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//add theem ke thua Controller
use App\Http\Controllers\Controller;

use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;

class MenuController extends Controller
{

    protected $menuService;
    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }
    public function create(){
        return view('admin.menu.add',[
            'title'=>'Thêm Danh mục mới',
            'menus'=>$this->menuService->getParent()
        ]);
    }
    //add menu

    public function store(CreateFormRequest $request)
    {
        //chay php artisan make:request Menu\CreateFormRequest : tao file trong phan requests

        $this->menuService->create($request);
        return redirect()->back();
    }

    public function getList()
    {
        return view('admin.menu.list',[
            'title'=>'Danh sách danh mục',
            'menus'=>$this->menuService->getList()
        ]);
    }

    public function destroy(Request $request)
    {
        $result=$this->menuService->destroy($request);
        if($result){
            return response()->json([
               'error'=>false,
               'message'=>'Xoá dữ liệu thành công'
            ]);
        }
        //else
        return response()->json([
           'error'=>true
        ]);
    }
}
