<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\TipeAkun;
use App\UserStatus;
use App\JadwalGuru;
use App\UserData;
use App\MataPelajaranGuru;
use App\MataPelajaran;
use DB;
use App\Notifikasi;
use App\KotaKab;

class Guru_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    public function index()
    {   
        $data['data'] = User::getListUserDefine(User::TIPE_GURU, '0');
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');

        //var_dump($data); die;
        return view('admin.guru_verification', $data);
    }

    public function verifikasi(Request $request)
    {   
        $this->validate($request, [
            'status' => 'required|numeric',
            'verif' => 'required|numeric'
        ]);

        $data = array('verified_profile' => $request->status);

        $update = UserStatus::where(UserStatus::COL_ID, $request->verif)->update($data);
        
        if (!$update) {
            $msg = [
                'error' => 'Verifikasi Guru Gagal',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Verifikasi Guru Sukses',
               ];

        return redirect()->back()->with($msg);

    }

    public function mapel($id)
    {   
        $data["guru"] = UserData::whereId($id)->first();
        $data["data"] = self::toList(MataPelajaranGuru::where('id_user', $id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        // untuk notifikasi
        $data["notif"]      = Notifikasi::where("is_admin", "1")->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        return view('admin.jadwal_verification', $data);
    }

    public function verifmapel(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|numeric',
            'verif' => 'required|numeric'
        ]);

        $data = array('status' => $request->status);
        $guru = MataPelajaranGuru::find($request->verif)->first();
        $status = array('accepted_teacher' => '1');
        
        try {
            DB::beginTransaction();

            MataPelajaranGuru::where(MataPelajaranGuru::COL_ID, $request->verif)->update($data);
            UserStatus::where(UserStatus::COL_ID, $guru->id_user)->update($status);
            
            DB::commit();

        }catch (\Exception $e){
            
            return redirect()->back()->with('error',"Error: Gagal Verifikasi Mata Pelajaran");
        }

        return redirect()->back()->with('success',"Success: Sukses Verifikasi Mata Pelajaran");
    }

}
