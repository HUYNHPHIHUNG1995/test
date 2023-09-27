<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Service\UploadService;

class UploadController extends Controller
{
    protected $upload;//this->upload

    public function __construct(UploadService $upload)
    {
        $this->upload=$upload;
    }

    public function store(Request $request)
    {
       // php artisan storage:link chay lenh nay

        $url = $this->upload->store($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url'   => $url
            ]);
        }

        return response()->json(['error' => true]);
    }
}
