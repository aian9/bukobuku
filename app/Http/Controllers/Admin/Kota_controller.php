<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\KotaKab;
use App\Provinsi;
use App\Notifikasi;

class Kota_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        
        $this->model = new KotaKab;
        $this->provinsi = new Provinsi;
    }

    public function index()
    {
        $data["data"] = KotaKab::paginate(10);
        $data["provinsi"] = self::toList(Provinsi::all()->toArray(), 'id');

        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();
        
        return view('admin.list_kota', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'namakota' => 'required',
            'idprovinsi' => 'required',
            'kodekota' => 'numeric|min:2'
        ]);

        $data=array('nama' => $request->namakota,
                    'kode_kota' => $request->kodekota,
                    'id_provinsi' => $request->idprovinsi);
        
        $insert = $this->model->insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Kota',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Data Kota',
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
        //
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
            'namakota' => 'required',
            'idprovinsi' => 'required',
            'kodekota' => 'numeric|min:2'
        ]);
        
        $data=array('nama' => $request->namakota,
                    'kode_kota' => $request->kodekota,
                    'id_provinsi' => $request->idprovinsi);
        
        $update = KotaKab::where($this->model::COL_ID, $request->idkota)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Kota',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Data Kota',
               ];

        return redirect()->back()->with($msg);
    }
}
