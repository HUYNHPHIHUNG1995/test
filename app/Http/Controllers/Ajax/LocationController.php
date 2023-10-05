<?php

namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\WardRepositoryInterface as WardRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;
    protected $wardRepository;
    public function __construct(
        DistrictRepository $districtRepository,
        ProvinceRepository $provinceRepository,
        WardRepository $wardRepository
    )
    {
        $this->districtRepository=$districtRepository;
        $this->provinceRepository=$provinceRepository;
        $this->wardRepository=$wardRepository;
    }

    public function getLocation(Request $request)
    {
        $get=$request->input();
        $html='';
        //$province_code=(int) $request->input('province_id');
        if($get['data']['id']!=0)
        {
            if($get['target']=='districts')
            {
                $province=$this->provinceRepository->findById($get['data']['id']);
                $html=$this->renderHtml($province->districts);//districts la phuong thuc dc dinh nghia o model

            }else if ($get['target']=='wards'){

                $district=$this->districtRepository->findById($get['data']['id']);
                $html=$this->renderHtml($district->wards,'[Chọn Phường/Xã]');//model wards
            }

            $response=[
                'html'=>$html
            ];
            return response()->json([
                'error'=>false,
                'res'=>$response
            ]);
        }else{
            $response=[
                'html'=>'<option value="0">[Chọn Quận/Huyện]</option>'
            ];
        }
        return response()->json([
            'res'=>$response,
            'error'=>true
        ]);
    }

    public function renderHtml($districs,$root='[Chọn Quận/Huyện]')
    {
        $html='<option value="0">'.$root.'</option>';
        foreach ($districs as $district)
        {
            $html.='<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}
