<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MataPelajaran;
use App\JenjangPendidikan;
use App\Notifikasi;

class Mapel_controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
        $this->model = new MataPelajaran;
    }

    public function index()
    {
        $data["data"] = MataPelajaran::paginate(10);
        $data["jenjang"] = self::toList(JenjangPendidikan::all()->toArray(), 'id');

        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.list_mapel', $data);
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
            'namamapel' => 'required',
            'idjenjang' => 'required',
            'kodemapel' => 'required'
        ]);

        $data=array('nama' => $request->namamapel, 'id_jenjang' => $request->idjenjang, 'kode'=> $request->kodemapel);

        $insert = MataPelajaran::insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Mata Pelajaran',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Mata Pelajaran',
               ];

        return redirect()->back()->with($msg);  
    }   

    public function update(Request $request)
    {
        $this->validate($request, [
            'namamapel' => 'required',
            'idjenjang' => 'required',
            'kodemapel' => 'required',
            'idmapel' => 'required'
        ]);

        $data=array('nama' => $request->namamapel, 'id_jenjang' => $request->idjenjang, 'kode'=> $request->kodemapel);

        $insert = MataPelajaran::where("id", $request->idmapel)->update($data);
        
        if (!$insert) {
            $msg = [
                'error' => 'Gagal Update Data Mata Pelajaran',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Mata Pelajaran',
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

}
