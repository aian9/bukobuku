<?php

namespace App\Http\Controllers\User;

use App\JenjangPendidikan;
use App\MataPelajaran;
use App\MataPelajaranGuru;
use App\MyHelper;
use App\User;
use App\UserData;
use App\UserStatus;
use App\Bidang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MataPelajaranGuruController extends Controller
{
    /**
     * @var User|null
     */
    protected $user;

    /**
     * @var UserData|UserStatus|null
     */
    protected $userdata;
    /**
     * DashboardUser constructor.
     */

    /**
     * MataPelajaranGuruController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new MataPelajaranGuru();
        $this->middleware(function ($request, $next)
        {
            $this->user = \Auth::user();
            $this->userdata = DB::table(UserData::TABLE)->join(UserStatus::TABLE,UserData::COL_ID,'=',UserStatus::COL_ID)->where(UserData::COL_ID,'=',$this->user->id)->first();

            if ($this->userdata->email_activated == false)
                return redirect(route('verification.email'));

            return $next($request);
        });

        $this->middleware(function ($request, $next){
            if ($this->user->tipe_akun != User::TIPE_GURU)
                return redirect(route('user.dashboard.index'));

            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mpg = MataPelajaranGuru::with('matpel','matpel.bidang')->whereIdUser($this->user->id)->get();
        
        return view('user.keahlian.index')->with(compact('mpg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matpel = MataPelajaran::with('bidang')->get();
        return view('user.keahlian.create')->with(compact('matpel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'matpel' => ['required','exists:'.MataPelajaran::TABLE.','.MyHelper::ColName(MataPelajaran::COL_ID)],
            'bidang' => ['required','exists:'.Bidang::TABLE.','.MyHelper::ColName(Bidang::COL_ID)],
            'tarif' => ['required','numeric']
        ],[
            'matpel.required' => 'Mata pelajaran harus diisi',
            'matpel.exists' => 'Mata pelajaran tidak valid',
            'bidang.required' => 'Bidang Pendidikan harus diisi',
            'bidang.exists' => 'Bidnag Pendidikan tidak valid',
            'tarif.required' => 'Tarif harus diisi',
            'tarif.numeric' => 'Tarif harus berupa angka'
        ]);

        $data=array('id_matpel' => $request->matpel,
                    'id_bidang' => $request->bidang,
                    'id_user' => $this->user->id,
                    'tarif' => $request->tarif,
                    'status' => MataPelajaranGuru::STATUS_UNVERIFIED);
        
        $insert = MataPelajaranGuru::insert($data);
        
        if (!$insert) {
            $msg = [
                'error' => 'Gagal Tambah Data Keahlian',
               ];

            return redirect()->back()->with($msg);
        }
        $msg = [
                'success' => 'Sukses Tambah Data Keahlian',
               ];

        return redirect()->back()->with($msg);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'matpel1' => ['required','exists:'.MataPelajaran::TABLE.','.MyHelper::ColName(MataPelajaran::COL_ID)],
            'bidang1' => ['required','exists:'.Bidang::TABLE.','.MyHelper::ColName(Bidang::COL_ID)],
            'tarif1' => ['required','numeric']
        ],[
            'matpel1.required' => 'Mata pelajaran harus diisi',
            'matpel1.exists' => 'Mata pelajaran tidak valid',
            'bidang1.required' => 'Bidang Pelajaran harus diisi',
            'bidang1.exists' => 'Bidang Pelajaran tidak valid',
            'tarif1.required' => 'Tarif harus diisi',
            'tarif1.numeric' => 'Tarif harus berupa angka'
        ]);

        $data=array('id_matpel' => $request->matpel1,
                    'id_bidang' => $request->bidang1,
                    'id_user' => $this->user->id,
                    'tarif' => $request->tarif1,
                    'status' => MataPelajaranGuru::STATUS_UNVERIFIED);
        
        $update = MataPelajaranGuru::where(MataPelajaranGuru::COL_ID, $request->idmatpel1)->update($data);
        
        if (!$update) {
            $msg = [
                'error' => 'Gagal Update Data Keahlian',
               ];

            return redirect()->back()->with($msg);
        }
        $msg = [
                'success' => 'Sukses Update Data Keahlian',
               ];
        
        return redirect("user/jadwal")->with($msg);
    }
}
