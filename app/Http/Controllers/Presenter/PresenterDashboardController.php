<?php

namespace App\Http\Controllers\Presenter;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PresenterDashboardController extends Controller
{
    public function dashboard(){
        // $log_login = DB::table('authentication_log')
        //             ->select('login_at','logout_at','user_agent','ip_address')
        //             ->where('authenticatable_id',Auth::user()->id)
        //             ->where('login_successful',1)
        //             ->orderBy('id','desc')
        //             ->get();
        $abstrak = count(Abstrak::all());
        $disetujui = count(Abstrak::where('status','disetujui')->get());
        $pending = count(Abstrak::where('status','pending')->get());
        $diteruskan = count(Abstrak::where('status','diteruskan')->get());
        $setting = Pengaturan::where('id',1)->first();
        return view('presenter/dashboard',[
            'abstrak'   => $abstrak,
            'disetujui'   => $disetujui,
            'pending'   => $pending,
            'diteruskan'   => $diteruskan,
            'setting' =>    $setting,
        ]);
    }
}
