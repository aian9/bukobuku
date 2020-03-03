<?php

namespace App\Http\Controllers\User;

use App\DataGuru;
use App\Jobs\SendEmailVerification;
use App\User;
use App\UserData;
use App\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * RegisterController constructor.
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegister($id = null){
        $data["tipe"] = 1;
        if($id==2){
            $data["tipe"] = 2;
        }
        
        return view('user.register', $data);
    }

    public function showRegisterGuru()
    {
        $data["tipe"] = 2;
        return view('user.register', $data);
    }

    public function doRegister(Request $request){

        $this->validate($request,[
            'email' => 'bail|required|email|unique:users',
            'username' => 'bail|required|alpha_dash|unique:users|min:5|max:50',
            'password' => 'bail|required|string|min:6|confirmed',
            'type' => 'required',
        ],[
            'email.required' => "Email harus diisi",
            'email.unique' => "Email sudah digunakan",
            'email.email' => "Email tidak sesuai format",
            'username.required' => "Username harus diisi",
            'username.alpha_dash' => "Username hanya boleh berisi huruf, angka, _, atau -",
            'username.unique' => "Username sudah digunakan",
            'username.min' => "Username minimal 5 karakter",
            'username.max' => "Username maksimal 50 karakter",
            'password.required' => "Password harus diisi",
            'password.confirmed' => "Password tidak sesuai",
            'password.min' => "Password minimal 6 karakter",
            'type.required' => "Jenis akun harus dipilih",
        ]);
        
        $user = new User();
        $userdata = new UserData();
        $userstatus = new UserStatus();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);

        if ($request->type==2){
            $user->tipe_akun = User::TIPE_GURU;
        }
        else{
            $user->tipe_akun = User::TIPE_MURID;
        }
        
        try {
            DB::beginTransaction();
            $user->save();
            $userdata->id = $user->id;
            $userdata->save();

            if ($user->tipe_akun==User::TIPE_GURU)
            {
                $dataguru = new DataGuru();
                $dataguru->id = $user->id;
                $dataguru->save();
            }
            
            $userstatus->id = $user->id;
            $userstatus->save();
            DB::commit();
            
           VerificationController::sendVerifikasi($user);

        }catch (\Exception $e){
            
            return redirect()->back()->with('error',"Error: Gagal membuat akun ");
        }
        
        return redirect()->back()->with('success',"success: Pendaftaran Berhasil ! Silahkan cek email Anda.");
    }
}
