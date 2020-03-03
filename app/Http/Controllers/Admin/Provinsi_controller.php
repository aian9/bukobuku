<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provinsi;
use App\Kecamatan;
use App\KotaKab;
use App\Notifikasi;
use Illuminate\Support\Facades\Redirect;

class Provinsi_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->model = new Provinsi;
    }

    public function index()
    {   
        $data["data"] = Provinsi::paginate(10);
        
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.list_provinsi', $data);
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
            'namaprovinsi' => 'required'
        ]);

        $data=array('nama' => $request->namaprovinsi);

        $insert = Provinsi::insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Provinsi',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Data Provinsi',
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
            'namaprovinsi' => 'required'
        ]);

        $data=array('nama' => $request->namaprovinsi);
        
        $update = Provinsi::where($this->model::COL_ID, $request->idprovinsi)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Provinsi',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Data Provinsi',
               ];

        return redirect()->back()->with($msg); 
    }

    public function list()
    {
        $files = \Illuminate\Support\Facades\Storage::allFiles('administratif');
        var_dump($files); die;
        $data = [];
        $i = 0;
        foreach ($files as $file){
            $i++;
            var_dump("list"); die;
            if (!preg_match('/administratif-/i',$file))
                continue;
            $json = \Illuminate\Support\Facades\Storage::get($file);
            $json = json_decode($json,true);
            var_dump("oke"); die;
        }
    
        var_dump("done"); die;
    }
}
