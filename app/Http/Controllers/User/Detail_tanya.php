<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\UserData;
use App\UserStatus;
use App\Tanya;
use App\DetailTanya;

class Detail_tanya extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();

            if ($this->userdata->email_activated == false)
                return redirect(route('verification.email'));

            return $next($request);
        });
        
        $this->middleware(function ($request, $next){
            if ($this->userdata->verified_profile == false)
                return redirect(route('user.dashboard.edit_profile'));
            
            return $next($request);
        })->except(['editProfile','editProfileAct']);

        $this->hari = [
            1 => "Senin",
            2 => "Selasa",
            3 => "Rabu",
            4 => "Kamis",
            5 => "Jum'at",
            6 => "Sabtu",
            7 => "Minggu"
        ];
        
        $this->jam = [6 => "06.00",1 => "06.00",7 => "07.00",8 => "08.00",1 => "08.00",9 => "09.00",10 => "10.00",
                    11 => "11.00",12 => "12.00",13 => "13.00", 14 => "14.00",15 => "15.00", 16 => "16.00",17 => "17.00",
                    18 => "18.00",19 => "19.00",20 => "20.00", 21 => "21.00"       
        ];
    }

    public function index($id)
    {
    	$data 				= [];
    	$data["data"] 		= Tanya::find($id);
    	$data["detail"]		= DetailTanya::where("id_tanya", $id)->get();
    	$data["listuser"] 	= self::toList(UserData::select('id','nama_lengkap','jenis_kelamin')->get()->toArray(), 'id');

    	return view("tanya.detail", $data);	
    }

    public function store(Request $req)
    {
    	$this->validate($req,[
            'pertanyaan' => 'bail|required|numeric|min:1|max:10',
            'jawaban' => 'bail|required|min:5|max:200',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'pertanyaan.required' => "Pertanyaan Tidak Valid",
            'pertanyaan.numeric' => "Pertanyaan Tidak Valid",
            'jawaban.required' => "Jawaban Harus Di Isi",
            'jawaban.min' => "Tanya minimal 5 karakter",
            'jawaban.max' => "Tanya maksimal 200 karakter"
        ]);

    	try {
    		DB::beginTransaction();
    		
    		$detail = new DetailTanya();

    		if ($this->user->tipe_akun==1) {
    			$detail->id_murid = $this->user->id;
    		}else{
    			$detail->id_guru = $this->user->id;
    		}
    		$detail->id_tanya = $req->pertanyaan;
    		$detail->jawaban  = $req->jawaban;
    		$detail->status   = 0;
    		$detail->save();

    		if ($req->foto) {
                $id = $detail->id."-".time().'.'.request()->foto->getClientOriginalExtension();

                $data = [];
                $data["foto"] = $id;
                DetailTanya::where("id", $detail->id)->update($data);

                if (file_exists('storage/uploads/diskusi/'.$id)) {
                    unlink('storage/uploads/diskusi/'.$id);
                }
                
                $uploads = request()->foto->move('storage/uploads/diskusi/', $id);
            }

    		DB::commit();
    	} catch (Exception $e) {
    		return redirect()->back()->with('error',"Error: Gagal membuat jawaban ");
    	}

    	return redirect()->back()->with('success',"Success: Sukses Membuat jawaban");
    }
}
