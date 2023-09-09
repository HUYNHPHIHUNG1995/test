<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//use App\User;



class LoginController extends Controller
{
    public function index()
    {
        return view('admin.users.login',[
            'title'=>'Đăng nhập hệ thống'
        ]);
    }

    public function store(Request $request)
    {

        $this->validate($request,
            [
                'email'=>'required|email:filter',
                'password'=>'required|min:4|max:100'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu quá ngắn,vui lòng nhập mật khẩu ít nhất 4 ký tự',
                'password.max'=>'Mật khẩu quá dài,vui lòng nhập mật khẩu ít hơn 100 ký tự'
            ]
        );
        //$2y$10$X6yVquq5N40idPkwGwaaL.2QjvQ3emzjjNHvLiijfuwtnjUJ2ih2
        //dd(Hash::make($request->input('password')));
        $data =
        [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $remember=$request->remember;

        if (Auth::attempt($data,$remember))
        {
            return redirect()->route('admin');

        }else{
            Session::flash('error','Email hoặc mật khẩu không đúng');
            return redirect()->back()->withInput();
        }


    }
}
