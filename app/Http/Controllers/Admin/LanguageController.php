<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\UpdateLanguagesRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;
    public function __construct(
        LanguageService $languageService,
        LanguageRepository $languageRepository
    )
    {
        $this->languageService = $languageService;
        $this->languageRepository=$languageRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        //$list=$this->userService->paginate();
        return view('admin.language.list',[
           'title'=>'Danh sách ngôn ngữ',
           'model'=>'Language',
            'listLanguages'=>$this->languageService->paginate($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.language.add',[
            'title'=>'Thêm mới ngôn ngữ'
        ]);
    }

    public function store(StoreLanguagesRequest $request)
    {
        if($this->languageService->create($request))
        {
            Session::flash('success','Thêm mới thành công');
            return redirect()->route('createLanguage');
        }
        Session::flash('error','Lỗi! Thêm mới không thành công');
        return redirect()->route('createLanguage')->withInput();
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
        $languageById=$this->languageRepository->findById($id);
        return view('admin.language.edit',[
            'title'=>'Sửa thành viên',
            'languageById'=>$languageById
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguagesRequest $request, string $id)
    {
        if($this->languageService->update($id,$request))
        {
            Session::flash('success','Sửa thành công');
            return redirect()->route('getListLanguage');
        }
        Session::flash('error','Lỗi! Sửa không thành công');
        return redirect()->route('editLanguage',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->input('getId');
        if($id!=null && $this->languageService->delete($id))
        {
            Session::flash('success','Xóa thành công');
            return redirect()->route('getListLanguage');
        }
        Session::flash('error','Lỗi! Xóa không thành công');
        return redirect()->route('getListLanguage');
    }
}
