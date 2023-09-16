<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Illuminate\Support\Facades\Session;
class MenuService
{
    public function create($request)
    {
        try{
            Menu::create([
                'name'=>(string) $request->name,
                'parent_id'=>(string) $request->parent_id,
                'description'=>(string) $request->description,
                'content'=>(string) $request->content,
                'active'=>(string) $request->active
            ]);

            Session::flash('success','Tạo danh mục thành công');

        }catch(\Exception $err){
            Session::flash('error',$err->getMessage());
            return false;
        }
        return true;
    }

    public function getParent()
    {
        return Menu::where('parent_id',0)->get();
    }

    public function getList()
    {
        return Menu::orderbyDesc('id')->paginate(20);

    }

    public function destroy($request)
    {
        $id=(int)$request->input('id');
        $menu=Menu::where('id',$id)->first();//laay duy nhat
        if($menu)
        {
            //xoa luon ca menu con
            return Menu::where('id',$id)->orWhere('parent_id',$id)->delete();
        }
        return false;
    }
}
