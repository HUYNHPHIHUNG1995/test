<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
//add theem ke thua Controller
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;

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
    public function edit(Menu $menu)
    {
        return view('admin.menu.edit',[
            'title'=>'Chỉnh sửa danh mục' .$menu->name,
            'menu'=>$menu,
            'menus'=>$this->menuService->getList()
        ]);
    }
    public function postEdit(Menu $menu,CreateFormRequest $request)
    {
        $this->menuService->edit($request,$menu);
        return redirect('/admin/menus/list');
    }
    public function destroy(Request $request)
    {
        $result = $this->menuService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }
}
