<?php

namespace App\Http\Controllers\User;

use App\DataGuru;
use App\Helper\TransaksiHelper;
use App\Http\Controllers\Controller;
use App\JadwalGuru;
use App\Bidang;
use App\Transaksi;
use App\User;
use App\UserData;
use App\UserStatus;
use App\Provinsi;
use App\KotaKab;
use App\Kecamatan;
use App\JenjangPendidikan;
use App\MataPelajaranGuru;
use App\MataPelajaran;
use App\Order;
use App\OrderDate;
use App\Tagihan;
use App\Bank;
use App\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Validator;
use Hash;
use Auth;
use App\Notifikasi;
use App\RekeningSapaGuru;
use DateTime;

class DashboardUser extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next)
        {   
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();
            
            $total = 0;
            if ($this->user->tipe_akun==2) {
               $total = Order::where("id_guru", $this->user->id)->count();
            }else{
                $total = Order::where("id_murid", $this->user->id)->count();
            }

            $request->session()->put('total', $total);

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
    
    public function index(){
        return redirect(route('dashboard'));

        return view('user.dashboard')->with(['user'=>$this->user,'userdata'=>$this->userdata]);
    }
    public function editProfile(){
        $dataguru = null;

        if ($this->user->tipe_akun == User::TIPE_GURU){
            $dataguru = DataGuru::whereId($this->user->id)->first();
        }
        
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["dataguru"] = $dataguru;
        $data["jenjang"] = self::toList(JenjangPendidikan::select('id','tingkat', 'nama')->get()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        
        return view('user.editprofile')->with($data);
    }

    public function editProfileAct(Request $request){

        $input = [
                'no_identitas' => $request->no_identitas,
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'jenjang_pendidikan' => $request->jenjang_pendidikan,
                'tempat_lahir' => $request->tempat_lahir_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat_jalan' => $request->alamat_jalan,
                'alamat_jalan_domisili' => $request->alamat_jalan_domisili,
                'alamat_kota' => $request->alamat_kota_id,
                'alamat_kota_domisili' => $request->alamat_kota_domisili_id,
                'no_hp' => $request->no_hp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'asal_sekolah' => $request->asal_sekolah,
                'status_sekolah' => $request->status_sekolah,
                'deskripsi' => $request->deskripsi
        ];

        $messages = [
            'no_identitas.required' => "Identitas harus diisi",
            'nama_lengkap.required' => "Nama lengkap harus diisi",
            'nama_lengkap.min' => "Nama lengkap terlalu pendek",
            'nama_lengkap.max' => "Nama lengkap terlalu panjang",
            'nama_panggilan.required' => "Nama panggilan harus diisi",
            'nama_panggilan.min' => "Nama panggilan terlalu pendek",
            'nama_panggilan.max' => "Nama panggilan terlalu panjang",
            'no_hp.required' => "Nomor HP harus diisi",
            'tempat_lahir.required' => "Tempat lahir harus diisi",
            'tempat_lahir.numeric' => "Tempat lahir tidak sesuai",
            'tanggal_lahir.required' => "Tanggal lahir harus diisi",
            'alamat_jalan.required' => "Alamat harus diisi",
            'alamat_kota_domisili.required' => "Alamat Kota domisili Harus diisi",
            'alamat_kota_domisili.numeric' => "Alamat Kota domisili Tidak Valid",
            'alamat_kota.required' => "Kota Asal Harus diisi",
            'alamat_kota.numeric' => "Kota Asal Tidak Valid",
            'jenjang_pendidikan.required' => "Jenjang pendidikan harus diisi",
            'jenis_kelamin.required' => "Jenis Kelamin Harus Diisi",
            'deskripsi.max' => 'Deskripsi Di Isi Maksimal 200 Karakter'
        ];

        $rules = [
            'no_identitas' => 'required',
            'nama_lengkap' => 'bail|required|string|min:2|max:50',
            'nama_panggilan' => 'bail|required|string|min:2|max:20',
            'no_hp' => 'required',
            'jenjang_pendidikan' => 'required',
            'tempat_lahir_id' => 'required',
            'tanggal_lahir' => 'required',
            'alamat_jalan' => 'required',
            'alamat_jalan_domisili' => 'required',
            'alamat_kota_id' => 'required|numeric',
            'alamat_kota_domisili_id' => 'required|numeric',
            'jenis_kelamin' => 'required',
            'deskripsi' => 'max:200'
        ];

        if ($this->user->tipe_akun == User::TIPE_GURU) {
            $rules['riwayatpendidikan'] = 'required';
        }

        $validator = Validator::make($input, $rules, $messages);

        $userdata = UserData::whereId($this->user->id)->first();
        $userstatus = UserStatus::whereId($this->user->id)->first();

        Validator::make($input, $rules, $messages);

        $userdata->no_identitas = $request->no_identitas;
        $userdata->nama_lengkap = $request->nama_lengkap;
        $userdata->nama_panggilan = $request->nama_panggilan;
        $userdata->no_hp = $request->no_hp;
        $userdata->tempat_lahir = $request->tempat_lahir_id;
        $userdata->tanggal_lahir = $request->tanggal_lahir;
        $userdata->alamat_jalan = $request->alamat_jalan;
        $userdata->alamat_kota = $request->alamat_kota_id;
        $userdata->alamat_jalan_domisili = $request->alamat_jalan_domisili;
        $userdata->alamat_kota_domisili = $request->alamat_kota_domisili_id;
        $userdata->jenjang_pendidikan = $request->jenjang_pendidikan;
        $userdata->jenis_kelamin = $request->jenis_kelamin;
        $userdata->deskripsi = $request->deskripsi;
        $userdata->link = $request->link;
        $userdata->asal_sekolah = $request->asal_sekolah;
        $userdata->status_sekolah = $request->status_sekolah;
        
        try{
            DB::beginTransaction();
            $userdata->save();
            if ($this->user->tipe_akun == User::TIPE_GURU)
            {
                $dataguru = DataGuru::whereId($this->user->id)->first();
                if ($dataguru==null) {
                    $dataguru = new DataGuru();
                    $dataguru->id = $this->user->id;
                }
                $dataguru->save();
            }
            
            $userstatus->verified_profile = true;
            $userstatus->save();
            DB::commit();
        }

        catch (\Exception $e){

            return redirect()->back()->with('error',"Error: Gagal menyimpan profil")->withInput();
        }
        
        // Untuk upload gambar setelah di simpan ke database
        if ($request->foto) {
            request()->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            if (file_exists('img/uploads/profile/'.$this->userdata->id.".jpg")) {
                unlink('img/uploads/profile/'.$this->userdata->id.".jpg");
            }
            
            $uploads = request()->foto->move('img/uploads/profile/', $this->userdata->id.".jpg");
        }
        
        // up;load gambar bukti foto identitas
        if ($request->foto_identitas) {
            request()->validate([
                'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
            if (file_exists('img/uploads/identitas/'.$this->userdata->id.".jpg")) {
                unlink('img/uploads/identitas/'.$this->userdata->id.".jpg");
            }
            
            $uploads = request()->foto_identitas->move('img/uploads/identitas/', $this->userdata->id.".jpg");
        }
        return redirect()->back()->with('success','Profil berhasil disimpan!');
    }

    public function editJadwalGuru(){
        if ($this->user->tipe_akun!=User::TIPE_GURU)
            return redirect(route('user.dashboard.index'));

        $jadwalDay = [
            "SENIN" => JadwalGuru::SENIN,
            "SELASA" => JadwalGuru::SELASA,
            "RABU" => JadwalGuru::RABU,
            "KAMIS" => JadwalGuru::KAMIS,
            "JUMAT" => JadwalGuru::JUMAT,
            "SABTU" => JadwalGuru::SABTU,
            "MINGGU" => JadwalGuru::MINGGU,
        ];
        $jadwalGurus = JadwalGuru::where('id_user','=',$this->user->id)->get();

        $jadwal = [];
        foreach ($jadwalGurus as $jadwalGuru){
            $jadwal[$jadwalGuru->day][$jadwalGuru->time] = true;
        }

        return view('user.edit_jadwal_guru')->with(compact('jadwalDay','jadwal'));
    }

    public function editJadwalGuruAct(Request $request){
        if ($this->user->tipe_akun!=User::TIPE_GURU)
            return redirect(route('user.dashboard.index'));


        if ($request->post('res')=='json'){
            $response['success'] = false;

            $id = $request->post('id');
            $day = (int) $id[0];
            $time = (int)substr($id,1);

            if ($time>21 || $time<7 || $day<1 || $day>7)
                return $response;

            $jadwal = JadwalGuru::where([[JadwalGuru::COL_ID_USER,'=',$this->user->id],[JadwalGuru::COL_DAY,'=',$day],[JadwalGuru::COL_TIME,'=',$time]])->first();
            if (empty($jadwal))
            {
                $response['type'] = 1;
                $jadwal = new JadwalGuru();
                $jadwal->id = $this->user->id*1000+$day*100+$time;
                $jadwal->id_user = $this->user->id;
                $jadwal->day = $day;
                $jadwal->time = $time;
                if ($jadwal->save())
                    $response['success'] = true;
            }
            else{
                $response['type'] = 0;
                try {
                    if($jadwal->delete())
                        $response['success'] = true;
                } catch (\Exception $e) {
                }
            }


            return $response;
        }
        else
        {
            $this->validate($request,[
                'day' => 'required|min:1|max:7',
                'timefrom' => 'required|integer|between:7,21',
                'timeto' => 'required|integer|between:7,22',
            ],[
                'day.required' => 'Hari harus diisi',
                'day.min' => 'Hari tidak valid',
                'day.max' => 'Hari tidak valid',
                'timefrom.required' => 'Waktu harus diisi',
                'timefrom.between' => 'Waktu tidak valid',
                'timeto.required' => 'Waktu harus diisi',
                'timeto.between' => 'Waktu tidak valid',
            ]);

            $day = $request->input('day');
            $timeto = $request->input('timeto');
            $timefrom = $request->input('timefrom');
            if ($timeto<=$timefrom)
                return redirect()->back()->withErrors(["Waktu tidak valid"]);

            try {
                DB::beginTransaction();
                for ($time=$timefrom;$time<$timeto;$time++){
                    $jadwal = JadwalGuru::where([[JadwalGuru::COL_ID_USER,'=',$this->user->id],[JadwalGuru::COL_DAY,'=',$day],[JadwalGuru::COL_TIME,'=',$time]])->first();
                    if (empty($jadwal)) {
                        $jadwal = new JadwalGuru();
                        $jadwal->id = $this->user->id * 1000 + $day * 100 + $time;
                        $jadwal->id_user = $this->user->id;
                        $jadwal->day = $day;
                        $jadwal->time = $time;
                        $jadwal->save();
                    }
                }
                DB::commit();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(["Gagal Menyimpan Jadwal"]);
            }

            return redirect()->back();
        }
    }

    public function saldo_default(){
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $saldo = TransaksiHelper::saldo($this->user->id);
        $saldoBefore = TransaksiHelper::saldoTillDate($this->user->id,$endDate);

        $transaksi = Transaksi::where(Transaksi::COL_ID_USER,'=',$this->user->id)
            ->whereDate(Transaksi::COL_CREATED_AT,'>=',$startDate)
            ->whereDate(Transaksi::COL_CREATED_AT,'<=',$endDate)
            ->orderBy(Transaksi::COL_ID,'desc')
            ->get();
        return view('user.saldo')->with(compact('saldo','transaksi','startDate','endDate','saldoBefore'));
    }

    public function saldo(Request $request){
        $this->validate($request,[
            'awal' => ['required_with:akhir','date'],
            'akhir' => ['required_with:awal','date'],
        ]);
        $startDate = empty($request->post('awal'))? Carbon::now()->startOfMonth():Carbon::parse($request->post('awal'));
        $endDate = empty($request->post('akhir'))? Carbon::now()->endOfMonth():Carbon::parse($request->post('akhir'));

        if($startDate->diffInDays($endDate) > 31)
            return redirect(route('user.dashboard.saldo'))->withErrors(['Rentang waktu maksimal adalah 31 hari']);

        $saldo = TransaksiHelper::saldo($this->user->id);
        $saldoBefore = TransaksiHelper::saldoTillDate($this->user->id,$endDate);

        $transaksi = Transaksi::where(Transaksi::COL_ID_USER,'=',$this->user->id)
            ->whereDate(Transaksi::COL_CREATED_AT,'>=',$startDate)
            ->whereDate(Transaksi::COL_CREATED_AT,'<=',$endDate)
            ->orderBy(Transaksi::COL_ID,'desc')
            ->get();
        return view('user.saldo')->with(compact('saldo','transaksi','startDate','endDate','saldoBefore'));
    }
    public function checkSpeed(){
        //place this before any script you want to calculate time
        $time_start = microtime(true);

        $userstatus = UserStatus::find($this->user->id);
        $userstatus->verified_profile = true;
        $userstatus->email_activated = true;
        $userstatus->save();
//        var_dump($user->status);
//        var_dump($user->cekStatus(User::STATUS_NOT_ACTIVATED_ACCOUNT));
//        $user->resetStatus(User::STATUS_EMAIL_ACTIVATED,User::STATUS_VERIFIED_PROFILE);
//        var_dump($user->status);


        $time_end = microtime(true);

        //dividing with 60 will give the execution time in minutes otherwise seconds
        $execution_time = ($time_end - $time_start);

        //execution time of the script
        echo '<b>Total Execution Time:</b> '.number_format((float) $execution_time, 10) .' Seconds';
        // if you get weird results, use
    }
    
    public function listguru()
    {   
        
        $data["data"] = User::getListUserDefine('2');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        
        return view('user.listguru', $data);
    }

    public function listorder()
    {   
        if ($this->user->tipe_akun!=2 and $this->user->tipe_akun!=10) {
            $msg = [
                'error' => 'Anda Tidak Memiliki Akses Ke Halaman',
               ];

            return redirect(route('user.dashboard.order'))->with($msg);
        }
        
        $data["data"] = User::getListUserDefine('2');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        $data["order"] = Order::getListOrder($this->user->id, 2);
        $data["listuser"] = self::toList(UserData::select('id','nama_lengkap')->get()->toArray(), 'id');
        $data["rating"] = self::Set_toArray(Rating::OrderList());

        // echo "<pre>"; 
        // var_dump($data["user"]->tipe_akun); die;
        
        return view('user.order', $data);
    }

    public function jadwal()
    {   
        $data["detail"] = $data["mdetail"] =[];
        
        $data["data"] = User::getListUserDefine('2');
        $data["jadwal"] = self::toList(JadwalGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["bidang"] = self::toList(Bidang::select('id','nama_bidang')->get()->toArray(), 'id');
        $data["jenjang"] = self::toList(JenjangPendidikan::select('id','tingkat', 'nama')->get()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["hari"] = $this->hari;
        $data["jam"] = $this->jam;
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        
        return view('user.listjadwal', $data);
    }

    public function jadwaledit($id = null)
    {   
        $data["data"] = User::getListUserDefine('2');
        $data["mdetail"] = [];
        $data["detail"] = self::Set_toArray(JadwalGuru::find($id));
        $data["jadwal"] = self::toList(JadwalGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["jenjang"] = self::toList(JenjangPendidikan::select('id','tingkat', 'nama')->get()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["hari"] = $this->hari;
        $data["jam"] = $this->jam;
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        
        return view('user.listjadwal', $data);
    }

    public function mapeledit($id = null)
    {   
        $data["data"] = User::getListUserDefine('2');
        $data["detail"] = [];
        $data["mdetail"] = self::Set_toArray(MataPelajaranGuru::find($id));
        $data["jadwal"] = self::toList(JadwalGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["bidang"] = self::toList(Bidang::select('id', 'nama_bidang')->get()->toArray(), 'id');
        $data["jenjang"] = self::toList(JenjangPendidikan::select('id','tingkat', 'nama')->get()->toArray(), 'id');
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["hari"] = $this->hari;
        $data["jam"] = $this->jam;
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::select('id','nama')->get()->toArray(), 'id');
        
        return view('user.listjadwal', $data);
    }

    public function order()
    {   
        if ($this->user->tipe_akun!=1 and $this->user->tipe_akun!=10) {
            $msg = [
                'error' => 'Anda Tidak Memiliki Akses Ke Halaman',
               ];
               
            return redirect(route('user.dashboard.listorder'))->with($msg);
        }

        $data["data"] = User::getListUserDefine('2');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        $data["order"] = Order::getListOrder($this->user->id, 1);
        $data["listuser"] = self::toList(UserData::all()->toArray(), 'id');
        $tagihan = Tagihan::where('id_user', $this->user->id)->get()->toArray();
        $data["rating"] = self::Set_toArray(Rating::OrderList());
        
        foreach($tagihan as $key => $value){
            if($value["expired_date"] < date("Y-m-d H:i:s") and $value["status"]==0){
                $id = $value["id"];
                $id_order = $value["id_order"];
                $data1 = ['status'=>'-1'];

                $update = Tagihan::where("id", $id)->update($data1);
                $update = Order::where(Order::COL_ID, $id_order)->update($data1);
            }
        }

        //die();
        return view('user.order', $data);
    }
    
    public function orderdetail($id)
    {   
        if (!$id) {
            return redirect(route('user.dashboard.listorder'))->with('Halaman Tidak Valid'); 
        }
        
        $detail = Order::find($id);
        $data_total = OrderDate::where('id_order', $id)->get()->count();

        if ($detail==null) {
            return redirect(route('user.dashboard.listorder'))->with('Halaman Tidak Valid, Data Mungkin Telah Dihapus'); 
        }
        
        if($data_total<$detail->durasi){
            for($i =1; $i<= $detail->durasi; $i++){
                $data = [];
                $data=array(
                    'keterangan' => "",
                    'id_order' => $id,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'status' => '0');

                $insert = OrderDate::insert($data);
            }
        }
        
        $data = [];
        $data["data"] = User::getListUserDefine('2');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["listmapel"] = self::toList(MataPelajaranGuru::where('id_user', $this->user->id)->get(), 'id');
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        $data["order"] = Order::find($id);
        $data["detail"] = OrderDate::where('id_order', $id)->get();
        
        return view('user.orderdetail', $data);
    }
    
    public function pembayaran($id)
    {   
        $order = Order::where('kode_transaksi', $id)->get(); 
        
        $data["data"] = User::getListUserDefine('2');
        $data["provinsi"] = Provinsi::select('id','code', 'nama')->get()->toArray();
        $data["user"] = $this->user;
        $data["userdata"] = $this->userdata;
        $data["kota"] = self::toList(KotaKab::select('id','kode_kota', 'nama')->get()->toArray(), 'kode_kota');
        $data["kecamatan"] = self::toList(Kecamatan::select('id', 'id_kota','kode_kecamatan','nama')->get()->toArray(), "id");
        $data["mapel"] = self::toList(MataPelajaran::all()->toArray(), 'id');
        $data["order"] = $order[0];
        $data["listuser"] = self::toList(UserData::select('id','nama_lengkap')->get()->toArray(), 'id');
        $data["bank"] = self::toList(Bank::all()->toArray(), 'id');
        $tagihan = self::Set_toArray(Tagihan::getTagihan($order[0]["id"]));
        $data["rekening"] = self::toList(RekeningSapaGuru::select('id','kode_bank', 'no_rekening','nama')
                            ->get()->toArray(), 'kode_bank');
        if($tagihan){
            $data["tagihan"] = $tagihan[0];
            $awal  = new DateTime($data["tagihan"]["expired_date"]);
            $akhir = new DateTime();
            $diff  = $awal->diff($akhir);
            
            $data["expired"] = $diff->format('%H Jam %i Menit %s Detik');
        }
        
        return view('user.pembayaran', $data);
    }

    public function Update_password(Request $request)
    {
        $current_password = $this->user->password;
        $msg = [];  
        if(Hash::check($request->password, $current_password)==true)
        {           
            $user_id = Auth::User()->id;                       
            $users = User::find($user_id);
            $users->password = bcrypt($request->password);
            $users->save(); 
            
            $msg = [
                'success' => 'Update Password Sukses',
               ];
        }
        else
        {           
            $msg = [
                'error' => 'Update Password Gagal, Password Yang Anda Masukan Salah',
               ];
        }  

        return redirect()->back()->with($msg);
    }
}
