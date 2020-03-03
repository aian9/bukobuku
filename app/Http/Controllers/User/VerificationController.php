<?php

namespace App\Http\Controllers\User;

use App\Jobs\SendEmailVerification;
use App\User;
use App\UserData;
use App\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

class VerificationController extends Controller
{
    /**
     * @var UserStatus $userstatus;
     */
    protected $userstatus;
    public function __construct()
    {   
        $this->middleware('auth')->except(['doVerification','generateLink']);
        $this->middleware(function ($request, $next){
            $this->userstatus = UserStatus::find(\Auth::user()->id);
            return $next($request);
        });
    }

    public function showVerification(){
        if ($this->userstatus->email_activated)
            return redirect(route('user.dashboard.index'));
        return view('user.verification');
    }

    public static function generateLink($user){
        if (empty($user))
            return "";

        $valid = base64_encode($user->username."|".Carbon::now()->toDateTimeString()."~".$user->email);
        for ($i=0;$i<strlen($valid);$i++){
            $valid[$i]= chr(ord($valid[$i])+1);
        }

        return URL::temporarySignedRoute(
            'verification.email.act', Carbon::now()->addHours(12), ['valid' => $valid]
        );
    }

    public function sendVerification(){
        // $user = \Auth::user();

        // if (empty($user) || $this->userstatus->email_activated)
        //     return redirect(route('user.dashboard.index'));

        // $link = self::generateLink($user);
        
        // Mail::to($user->email)->send(new \App\Mail\EmailVerification($link));
        // return redirect()->back();

        //copy dari sendVerifikasi
        try {
            $usr = \Auth::user();
            $user = User::where('email', $usr->email)->get()->toArray();

            $link = url('/verifikasi')."/".Crypt::encryptString($user[0]["id"]);
            
            if($user[0]["tipe_akun"]==1)
            {
                \Mail::to($user[0]['email'])->send(new \App\Mail\EmailVerification($link));
            }
            else
            {
                \Mail::to($user[0]['email'])->send(new \App\Mail\EmailVerificationGuru($link));
            }

        } catch (Exception $e) {

         return redirect()->route('register')->with('error',"Error: Gagal Verifikasi akun ".$e->getMessage());
        }
        
        return redirect()->route('login')->with('success',"success: Silahkan Cek Email Anda");
    }

    public function doVerification(Request $request){
        if(!URL::hasValidSignature($request))
            return "Invalid Request";
        $valid = $request->get('valid');
        for ($i=0;$i<strlen($valid);$i++){
            $valid[$i]= chr(ord($valid[$i])-1);
        }
        $user = base64_decode($valid);
        $user = preg_split('/~/i',$user);
        $user = User::whereEmail($user[1])->first();

        if (empty($user))
            return "Invalid Email";
        if (!$this->userstatus->email_activated) {
            $this->userstatus->email_activated = true;
            $this->userstatus->save();
        }
        return view('user.verification_successfull');
    }
    
    public static function sendVerifikasi($user)
    {   
        try {
            $user = User::where('email', $user->email)->get()->toArray();
            
            $link = url('/verifikasi')."/".Crypt::encryptString($user[0]["id"]);
            
            if($user[0]["tipe_akun"]==1)
            {
                \Mail::to($user[0]['email'])->send(new \App\Mail\EmailVerification($link));
            }
            else
            {
                \Mail::to($user[0]['email'])->send(new \App\Mail\EmailVerificationGuru($link));
            }

        } catch (Exception $e) {

         return redirect()->route('register')->with('error',"Error: Gagal Verifikasi akun ".$e->getMessage());
        }
        
        return redirect()->route('login')->with('success',"success: Silahkan Cek Email Anda");
    }
    
}
