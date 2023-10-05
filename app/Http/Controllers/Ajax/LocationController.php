<?php

namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    protected $districtRepository;

    public function __construct(
        DistrictRepository $districtRepository
    )
    {
        $this->districtRepository=$districtRepository;
    }

    public function getLocation(Request $request)
    {
        $province_code=(int) $request->input('province_id');
        $districts=$this->districtRepository->findByProvinceCode($province_code);
        $response=[
          'html'=>$this->renderHtml($districts)
        ];
        return response()->json($response);
    }

    public function renderHtml($districs)
    {
        $html='<option value="0">[Chọn Quận/Huyện]</option>';
        foreach ($districs as $district)
        {
            $html.='<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}
