<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserData;
use App\User;
use App\UserStatus;
use DB;
use App\Pengaduan;
use App\Notifikasi;
use Illuminate\Support\Facades\Route;
use App\Tanya;
use App\DetailTanya;

class TanyaController extends Controller
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
    
    public function index()
    {	
    	$data["notif"]      = Notifikasi::where("id", $this->user->id)->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("id", $this->user->id)->where("status", "0")->get()->toArray();
        
    	return view('tanya.dashboard', $data);
    }
    
    public function pertanyaan(Request $req)
    {	
    	if ($req->s_judul) {
            $data["data"]       = Tanya::where("id_murid", $this->user->id)->where("judul", "like",  '%'.$req->s_judul.'%')->orderBy("id", "DESC")->paginate(10);
        }elseif($this->user->tipe_akun==2){
           $data["data"]       = Tanya::where("status", ">", "0")->orderBy("id", "DESC")->paginate(2);
        }else{
            $data["data"]       = Tanya::where("id_murid", $this->user->id)->orderBy("id", "DESC")->paginate(2);
        }

        $data["tanya"]      = Tanya::where("id_murid", $this->user->id);
        $data["guru"]       = UserStatus::where("accepted_teacher", "1")->get()->toArray();
        $data["jawab"]      = DetailTanya::where("status", "1");
    	$data["notif"]      = Notifikasi::where("id", $this->user->id)->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("id", $this->user->id)->where("status", "0")->get()->toArray();
        $data["user"]       = $this->user;
        
    	return view('tanya.pertanyaan', $data);
    } 

    public function store(Request $req)
    {
        $this->validate($req,[
            'judul' => 'bail|required|min:5|max:50',
            'tanya' => 'bail|required|min:10|max:200',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'judul.required' => "Judul harus diisi",
            'tanya.unique' => "Tanya harus diisi",
            'tanya.min' => "Tanya minimal 10 karakter",
            'tanya.max' => "Tanya maksimal 200 karakter",
            'judul.min' => "Judul minimal 5 karakter",
            'judul.max' => "Judul maksimal 50 karakter"
        ]);

        try {
            
            DB::beginTransaction();

            $tanya = new Tanya();
            $tanya->judul = $req->judul;
            $tanya->id_murid = $this->user->id;
            $tanya->pertanyaan = $req->tanya;
            $tanya->status = 0;
            $tanya->created_at = date("Y-m-d H:i:s");
            $tanya->updated_at = date("Y-m-d H:i:s");
            $tanya->save();

            if ($req->foto) {
                $id = $tanya->id."-".time().'.'.request()->foto->getClientOriginalExtension();

                $data = [];
                $data["foto"] = $id;
                Tanya::where("id", $tanya->id)->update($data);

                if (file_exists('storage/uploads/tanya/'.$id)) {
                    unlink('storage/uploads/tanya/'.$id);
                }
                
                $uploads = request()->foto->move('storage/uploads/tanya/', $id);
            }

            DB::commit();
        } catch (Exception $e) {
            return redirect()->back()->with('error',"Error: Gagal membuat pertanyaan ");
        }

        return redirect()->back()->with('success',"Success: Sukses Membuat Pertanyaan");
    }   

    public function edit($id)
    {   
        $data["user"]       = $this->user;
        $data["data"]       = Tanya::where("id_murid", $this->user->id)->orderBy("id", "DESC")->paginate(2);
        $data["edit"]       = Tanya::find($id);
        $data["notif"]      = Notifikasi::where("id", $this->user->id)->orderBy('id', 'DESC')->get()->toArray();
        $data["total"]      = Notifikasi::where("id", $this->user->id)->where("status", "0")->get()->toArray();

        return view('tanya.pertanyaan', $data);
    }   

    public function update(Request $req)
    {
        $this->validate($req,[
            'id_tanya' => 'bail|numeric|required|min:1|max:50',
            'judul' => 'bail|required|min:5|max:50',
            'tanya' => 'bail|required|min:10|max:200',
            'foto'  => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'id_tanya.required' => 'Data harus valid',
            'id_tanya.min' => 'Data harus valid',
            'id_tanya.max' => 'Data harus valid',
            'judul.required' => "Judul harus diisi",
            'tanya.unique' => "Tanya harus diisi",
            'tanya.min' => "Tanya minimal 10 karakter",
            'tanya.max' => "Tanya maksimal 200 karakter",
            'judul.min' => "Judul minimal 5 karakter",
            'judul.max' => "Judul maksimal 50 karakter"
        ]);

        try {

            DB::beginTransaction();

            $data = [];

            if ($req->foto) {
                $id = $req->id_tanya."-".time().'.'.request()->foto->getClientOriginalExtension();
                
                $data["foto"] = $id;

                if (file_exists('storage/uploads/tanya/'.$id)) {
                    unlink('storage/uploads/tanya/'.$id);
                }
                
                $uploads = request()->foto->move('storage/uploads/tanya/', $id);
            }

            $data["judul"] = $req->judul;
            $data["id_murid"] = $this->user->id;
            $data["pertanyaan"] = $req->tanya;
            $data["updated_at"] = date("Y-m-d H:i:s");
            
            Tanya::where("id", $req->id_tanya)->update($data);
            
            DB::commit();
        } catch (Exception $e) {
            return redirect()->back()->with('error',"Error: Gagal edit pertanyaan");
        }

        return redirect()->route('tanya.pertanyaan')->with('success',"Success: Sukses edit Pertanyaan");
    } 

    public function destroy($id)
    {   
        $data = [];
        $data = Tanya::find($id);
        
        if (file_exists('storage/uploads/tanya/'.$data["foto"])) {
            unlink('storage/uploads/tanya/'.$data["foto"]);
        }

        $data->delete();

        return redirect()->route('tanya.pertanyaan')->with('success',"Success: Sukses Hapus Pertanyaan");
    }
}
