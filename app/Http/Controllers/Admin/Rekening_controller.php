<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RekeningSapaGuru;
use App\Bank;
use DB;
use App\UserData;
use App\User;
use App\UserStatus;
use App\Notifikasi;

class Rekening_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();
            
            return $next($request);
        });
        $this->model = new RekeningSapaGuru();
    }


    public function index()
    {
        $data["bank"] = self::toList(Bank::select("id", "kode_bank", "nama_bank")->get()->toArray(), "kode_bank");

        $data["notif"]      = Notifikasi::where("is_admin", "1")->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("is_admin", "1")->where("status", "0")->get()->toArray();

        $data["data"] = RekeningSapaguru::all()->toArray();

    	return view("admin.listrekening", $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_bank' => 'bail|required|numeric',
            'no_rekening' => 'required|min:5',
            'nama' => 'required|min:4'
        ]);

        $data=array('kode_bank' => $request->kode_bank,
                    'no_rekening' => $request->no_rekening,
                    'nama' => $request->nama);

        $insert = RekeningSapaguru::insert($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Rekening Sapaguru',
               ];

            return redirect()->back()->with($msg);
        }

        $msg = [
                'success' => 'Sukses Tambah Data Rekening Sapaguru',
               ];

        return redirect()->back()->with($msg); 
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'kode_bank' => 'bail|required|numeric',
            'no_rekening' => 'required|numeric',
            'nama' => 'required'
        ]);

        $data=array('kode_bank' => $request->kode_bank,
                    'no_rekening' => $request->no_rekening,
                    'nama' => $request->nama);

        $insert = RekeningSapaguru::where($this->model::COL_ID, $request->idrekening)->update($data);

        if (!$insert) {
            $msg = [
                'error' => 'Gagal Update Data Rekening Sapaguru',
               ];

            return redirect()->back()->with($msg);
        }
        
        $msg = [
                'success' => 'Sukses Update Data Rekening Sapaguru',
               ];

        return redirect()->back()->with($msg); 
    }
}
