<?php

namespace App\Http\Controllers;

use App\Kecamatan;
use App\KotaKab;
use Illuminate\Http\Request;

class API extends Controller
{
    public function getDistrict(Request $request){
        $data['success'] = false;
        if (\Auth::guard()->check()) {
            
            try {
                $kota = [];
                $kec = [];
                if(isset($request->a) && !empty($request->a))
                    $kota = KotaKab::whereIdProvinsi($request->a)->get(['id', 'nama', 'kode_kota as kode']);
                $data['kota'] = $kota;

                if(isset($request->b) && !empty($request->b))
                    $kec = Kecamatan::whereIdKota($request->b)->get(['id', 'nama', 'kode_kecamatan as kode']);
                $data['kec'] = $kec;
                $data['success'] = true;
            }
            catch (\Exception $exception)
            {
                return $exception->getMessage();
            }

        }
        return $data;
    }
}
