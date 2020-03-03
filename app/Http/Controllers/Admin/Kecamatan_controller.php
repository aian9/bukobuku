<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KotaKab;
use App\Provinsi;
use App\Kecamatan;
use App\Notifikasi;

class Kecamatan_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        
        $this->model = new Kecamatan;
        $this->provinsi = new Provinsi;
        $this->kota = new KotaKab;
    }

    public function index()
    {
        $data["data"] = Kecamatan::paginate(10);
        $data["kota"] = self::toList(KotaKab::all()->toArray(), 'kode_kota');
        
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.list_kecamatan', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'namakecamatan' => 'required',
            'idkota' => 'required',
            'kodekecataman' => 'numeric|min:2'
        ]);

        $data=array('nama' => $request->namakecamatan,
                    'kode_kecamatan' => $request->kodekecataman,
                    'id_kota' => $request->idkota);

        $insert = $this->model->insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Kecamatan',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Data Kecamatan',
               ];

        return redirect()->back()->with($msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        $this->validate($request, [
            'namakecamatan' => 'required',
            'idkota' => 'required',
            'kodekecataman' => 'numeric|min:2'
        ]);
        
        $data=array('nama' => $request->namakecamatan,
                    'kode_kecamatan' => $request->kodekecataman,
                    'id_kota' => $request->idkota);

        $update = Kecamatan::where($this->model::COL_ID, $request->idkecamatan)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Kecamatan',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Data Kecamatan',
               ];

        return redirect()->back()->with($msg);
    }
}
