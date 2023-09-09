<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
//add theem ke thua Controller
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function create(){
        return view('admin.menu.add',[
            'title'=>'Thêm Danh mục mới'
        ]);
    }
}
