<?php
namespace App\Http\Service;

class UploadService
{
    //upload file vao thu muc storage/app/
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $name = $request->file('file')->getClientOriginalName();//lay ten anh
                $pathFull = 'uploads/' . date("Y/m/d");//tao thu muc uploads trc roi luu vao thu muc qua link nay : upload/nam/thang/ngay

                $request->file('file')->storeAs(
                    'public/' . $pathFull, $name
                );

                return '/storage/' . $pathFull . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}
