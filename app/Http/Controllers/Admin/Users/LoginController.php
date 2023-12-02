<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\LoginRequest;
//use App\User;



class LoginController extends Controller
{
    public function index()
    {
        //neu da dang nhap roi thi vao thang trang quan tri
        if(Auth::id()>0)
        {
            return redirect()->route('admin');
        }
        return view('admin.auth.login',[
            'title'=>'Đăng nhập hệ thống'
        ]);
    }

    public function store(LoginRequest $request)
    {
        //composer require yoeunes/toastr : cai thu vien nay de dung Session::flash đẹphơn
        $data =
        [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember=$request->remember;

        if (Auth::attempt($data,$remember))
        {
            Session::flash('success','Đăng nhập thành công');
            return redirect()->route('admin');

        }else{
            Session::flash('error','Email hoặc mật khẩu không đúng');
            return redirect()->back();
        }


    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Session::flash('success','Đăng xuất thành công');
        return redirect()->route('login');
    }
}
