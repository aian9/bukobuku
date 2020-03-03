<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\JadwalGuru;
use Validator;
use App\Notifikasi;

class Jadwal_controller extends Controller
{   
    protected $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = \Auth::user();
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();

            return $next($request);
        });

        $this->model = new JadwalGuru();
    }

    public function index()
    {
        $data["data"] = $this->model->index();
        $data["provinsi"] = self::toList(Provinsi::all()->toArray(), 'id');
        
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();
        
        return view('admin.list_kota', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'hari' => 'required|min:1|numeric',
            'jam' => 'required|min:1|numeric',
            'jam_akhir' => 'required|min:1|numeric'
        ]);
        
        $data=array('id_user' => $this->user->id,
                    'day' => $request->hari,
                    'time' => $request->jam,
                    'end_time' => $request->jam_akhir);
        
        $insert = JadwalGuru::insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Jam Pelajaran',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Jam Pelajaran',
               ];

        return redirect()->back()->with($msg); 
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'hari1' => 'required|min:1|numeric',
            'jam1' => 'required|min:1|numeric',
            'jam_akhir1' => 'required|min:1|numeric'
        ]);
        
        $data=array('id_user' => $this->user->id,
                    'day' => $request->hari1,
                    'time' => $request->jam1,
                    'end_time' => $request->jam_akhir1);
        
        $update = JadwalGuru::where($this->model::COL_ID, $request->idwaktu1)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Jam Pelajaran',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Jam Pelajaran',
               ];

        return redirect("user/jadwal")->with($msg); 
    }
}
