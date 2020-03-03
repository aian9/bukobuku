<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Mail;
use App\JadwalGuru;
use App\Transaksi;
use App\Provinsi;
use App\KotaKab;
use App\Kecamatan;
use App\User;
use App\UserData;
use App\JenjangPendidikan;
use App\DataGuru;
use App\MataPelajaran;
use App\MataPelajaranGuru;
use App\Order;
use App\Rating;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Crypt;
use App\UserStatus;
use App\Log_Password;
use Auth;
use App\Bidang;

class Dashboard extends Controller
{
    use AuthenticatesUsers;
    protected $decayMinutes = 10;
    protected $user;

    public function __construct()
    {
        $this->user = \Auth::user();
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

        $this->durasi = [1=> "1 Jam", 2=> "2 Jam",3=> "3 Jam",4=> "4 Jam",5=> "5 Jam",6=> "6 Jam"];
    }

    public function index()
    {
        return view('landing.content');
    }

    public function redirectTo(){
        
        return route('user.dashboard.index');
    }
    
    public function about()
    {
    	return view('landing.about');
    }
    
    public function listguru(Request $request)
    {   
        $data["data"] = User::getListUserDefine('2', 1); 
        $data["guru"] = User::getListUserDefine('2', 1); 
    
        if ($_POST) {
          $a_data = array('mapel' => $request->mapel,'id_kota'=>$request->kota_id,'jam'=>$request->jam, 'id_bidang'=> $request->bidang);
          if($a_data["mapel"]!=0 || $a_data["id_kota"]!=NULL || $a_data["jam"]!=0 || $a_data["id_bidang"]!=0)
          {
              $data["data"] = DataGuru::getListGuru($a_data);
          }
        }
        
        $data["provinsi"] = self::toList(Provinsi::select('id','nama','code')->get()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["mapel"] = MataPelajaran::all()->toArray();
        $data["bidang"] = self::toList(Bidang::select("id", "nama_bidang")->get()->toArray(), "id");
        $data["jenjang"] = self::toList(JenjangPendidikan::select("id", "nama", "tingkat")->get()->toArray(), "id");
        $data["jam"] = $this->jam;
        $data["rating"] = self::Set_toArray(Rating::GuruList());
        
        if (count($data["data"])<1) {
            $data["error"] = "Data Yang Anda Cari Tidak Ada";
        }
        
    	return view('landing.listguru', $data);
    }
    
    public function forgot()
    {   
        return view('user.forgotten');
    }
    
    public function editProfile(){
        $dataguru = null;
        
        $dataguru = DataGuru::whereId($this->user->id)->first();
        
        return view('user.editprofile')->with(['user'=>$this->user,'userdata'=>$this->userdata,'dataguru'=>$dataguru]);
    }

    public function getDistrict(Request $request)
    {   
        $data['success'] = false;

        try {
            $kota = [];
            $kec = [];
            if(isset($request->a) && !empty($request->a))
                $kota = KotaKab::whereIdProvinsi($request->a)->get(['id', 'nama', 'kode_kota as kode']);
            $data['kota'] = $kota;

            if(isset($request->b) && !empty($request->b))
                $kec = Kecamatan::whereIdKota($request->b)->get(['id', 'nama', 'kode_kecamatan as kode']);
            $data['kec'] = $kec;
            $data['success'] = true;
        }
        catch (\Exception $exception)
        {
            return $exception->getMessage();
        }

        return $data;
    }

    public function loadKota(Request $request)
    {
        $term = $request->term;
        
        $query = "select k.id,k.kode_kota, CONCAT(k.nama, ' , Provinsi ', p.nama) as nama
        from kota_kab k join provinsi p on k.id_provinsi=p.code where k.nama like '%".$term."%' ";
        
        $data = DB::select($query);

        foreach ($data as $query)
        {
            $results[] = ['id' => $query->id, 'kode_kota' => $query->kode_kota,'value' => $query->nama]; 
        }

        return response()->json($results);
    }

    public function loadKecamatan(Request $request)
    {
        $term   = $request->term;
        $sql    = "select k.kode_kecamatan,CONCAT(c.nama,' , ',k.nama, ' , Provinsi ', p.nama) as nama 
                    from kecamatan c join kota_kab k on c.id_kota=k.kode_kota
                    join provinsi p on k.id_provinsi=p.id where c.nama like '%".$term."%' ";

        $data   = DB::select($sql);

        foreach ($data as $query)
        {
            $results[] = ['id' => $query->id, 'value' => $query->nama]; 
        }

        return response()->json($results);
    }

    public function detailguru($id)
    {   
        $data["jadwal"] = self::toList(JadwalGuru::where('id_user', $id)->get()->sortBy('time')->sortBy('day'), 'id');
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $id)->where("status", "1")->get(), 'id');
        $data["user"] = User::find($id);

        // replace string watch di youtube
        $user1 = UserData::find($id); 
        $user1["link"] = str_replace("watch?v=", "embed/", $user1["link"]);
        $data["userdata"] = $user1;
        
        $data["hari"] = $this->hari;
        $data["jam"] = $this->jam;
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        //$data["mapel"] = DB::select($query);
        $data["provinsi"] = Provinsi::index();
        $data["bidang"] = self::toList(Bidang::all()->toArray(), 'id');
        $data["jenjang"] = self::toList(JenjangPendidikan::all()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["provinsi"] = self::toList(Provinsi::select('id','nama','code')->get()->toArray(), 'id');
        $data["guru"] = User::getListUserDefine('2', '1');
        $data["durasi"] = $this->durasi;
        $data["rating"] = self::Set_toArray(Rating::GuruList());
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        
        return view('user.detail', $data);
    }

    public function gettotal(Request $request)
    {   
        $input = [
            'id_guru' => $request->id_guru,
            'id_matpel' => $request->id_matpel
        ];

        if ($input["id_matpel"]==null or $input["id_matpel"]==0) {
            $data = array('tarif' => 0);
            
            return response()->json($data);
        }else{
            $data = MataPelajaranGuru::getTotal($input);

            return response()->json($data[0]);
        }
    }   

    public function Rating(Request $request)
    {   $this->validate($request,[
                'id_order' => 'bail|required|min:1',
                'rating' => 'bail|required|min:1'
            ],[
                'id_order.required' => "Order Harus Terisi",
                'id_order.number' => "Order Tidak Valid",
                'rating.required' => "Rating Harus Terisi",
                'rating.number' => "Order Tidak Valid"
            ]);
        
        $data = Order::find($request->id_order);
        
        try {
            $rating = new Rating();
            $rating->id_guru = $data["id_guru"];
            $rating->rating = $request->rating;
            $rating->id_order = $request->id_order;
            $rating->keterangan = $request->keterangan;
            $rating->id_murid = $data["id_murid"];
            $rating->save();
        }catch (\Exception $e){
            
            return redirect()->back()->with('error',"Error: Gagal Memberi Rating Guru ");
        }

        return redirect()->back()->with('success',"success: Sukses Memberi Rating Guru");
    }

    public function sendEmail(Request $req)
    {   

        $user = User::where('email', $req->email)->get()->toArray();
        $log = Log_Password::where("email", $req->email)->whereDate('created_at', '=', date('Y-m-d'))->get()->toArray();
            
        if (count($user)<1) {
            return redirect()->back()->with('error',"Error: Email Tidak Terdaftar");
        }

        if (count($log)>2) {
            return redirect()->back()->with('error',"Error: Anda Sudah Request Perubahan Password Lebih Dari 2 Kali");
        }

        try {

            $link = route('forgotten.confirm')."/".Crypt::encryptString($user[0]["id"]);

            \Mail::to($user[0]['email'])->send(new \App\Mail\ForgotMail($link));

            $log1 = new Log_Password();
            $log1->id_user= $user[0]["id"];
            $log1->email   = $req->email;
            $log1->created_at = date("Y-m-d H:i:s");
            $log1->updated_at =  date("Y-m-d H:i:s");
            $log1->save();

        } catch (Exception $e) {

         return redirect()->back()->with('error',"Error: Gagal membuat akun ");
        }
        
        return redirect()->back()->with('success',"success: Silahkan Cek Email Anda");
    }

    public function Konfirmasi($id)
    {   
        if (Auth::user()) {
            return redirect()->back()->with('error',"success: Akses Terbatas");
        }

        $data["data"] = Crypt::decryptString($id);

        return view('user.password_confirm', $data);
    }   

    public function Update_password(Request $request)
    {

        $msg = [];

        $this->validate($request,[
            'iduser' => 'numeric|required|',
            'password' => 'bail|required|string|min:6|confirmed'
        ],[
            'iduser.required' => "User harus valid",
            'iduser.numeric' => "User harus valid",
            'password.required' => "Password harus diisi",
            'password.confirmed' => "Password tidak sesuai",
            'password.min' => "Password minimal 6 karakter"
        ]);

        try {
            
            $user_id = $request->iduser;                    
            $users = User::find($user_id);
            $users->password = bcrypt($request->password);
            $users->save();

        } catch (Exception $e) {

            $msg = [
            'error' => 'Gagal Konfirmasi Perubahan Password',
           ]; 

           return redirect()->back()->with($msg);
        }

        $msg = [
            'success' => 'Perubahan Password Sukses',
           ]; 

        return redirect()->route('login')->with($msg);
    }

    public function verifikasi($req)
    {    
        $id = Crypt::decryptString($req);

        try {   
                $status = array('email_activated' => 1);

                $ore =UserStatus::where("id", $id)->update($status);
                
            } catch (Exception $e) {

            $msg = [
            'error' => 'Gagal Konfirmasi Email',
           ]; 
           
           return redirect('register')->route('login')->with($msg);
        }

        $msg = [
            'success' => 'Berhasil Konfirmasi Email, Silahkan Login',
           ]; 

        return redirect()->route('login')->with($msg);
    }

    public function getmapel($id)
    {
        $data = MataPelajaranGuru::getByIduser($id);

        echo json_encode($data);
    }

    public function getjenjangmapel($id)
    {
        $data = MataPelajaran::select("id", "nama", "kode")->where("id_jenjang", $id)->get()->toArray();

        echo json_encode($data);
    }

    public function getbidangmapel($id)
    {
        $data = MataPelajaran::select("id", "nama", "kode")->where("id_bidang", $id)->get()->toArray();

        echo json_encode($data);
    }
}
