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
        $this->upload->store($request);
    }
}
