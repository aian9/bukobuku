<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\JenjangPendidikan;
use App\Notifikasi;

class Jenjang_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');

        $this->model = new JenjangPendidikan;
    }

    public function index()
    {   
        $data["data"] = JenjangPendidikan::paginate(10);
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.listjenjang', $data);
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
            'namajenjang' => 'required'
        ]);

        $data=array('nama' => $request->namajenjang,
                    'tingkat' => $request->tingkat);

        $insert = JenjangPendidikan::insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Jenjang Pendidikan',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Jenjang Pendidikan',
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
    
    public function update(Request $request)
    {   
        $this->validate($request, [
            'namajenjang' => 'required'
        ]);

        $data=array('nama' => $request->namajenjang,
                    'tingkat' => $request->tingkat);
        
        $update = JenjangPendidikan::where($this->model::COL_ID, $request->id)->update($data);

        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Jenjang Pendidikan',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Update Data Jenjang Pendidikan',
               ];

        return redirect()->back()->with($msg); 
    }
}
