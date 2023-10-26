<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class DashboardController extends Controller
{
    public function __construct()
    {
        
    }

    public function changeStatus(Request $request){
        $data = $request->input(); 
        //ucfist la viet in hoa chu cai dau tien. 
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($data['model']).'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        if($serviceInstance->updateStatus($data)){
            return response()->json(['success'=>true]);
        }
    }

    public function changeAllStatus(Request $request){
        $data = $request->input(); 
        //ucfist la viet in hoa chu cai dau tien. 
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($data['model']).'Service';
        if(class_exists($serviceInterfaceNamespace)){
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        
        if($serviceInstance->updateAllStatus($data)){
            return response()->json([
                'success'=>true,
                'flag'=>'true'
            ]);
        }
    }
}
