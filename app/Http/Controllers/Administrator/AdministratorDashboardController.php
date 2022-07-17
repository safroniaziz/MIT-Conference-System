<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdministratorDashboardController extends Controller
{
    public function dashboard(){
        $log_login = DB::table('authentication_log')
                    ->join('users','users.id','authentication_log.authenticatable_id')
                    ->select('login_at','logout_at','username','access','user_agent','ip_address')
                    ->where('access','!=','administrator')
                    ->orderBy('authentication_log.id','desc')
                    ->get();
        $abstrak = count(Abstrak::all());
        $disetujui = count(Abstrak::where('status','disetujui')->get());
        $pending = count(Abstrak::where('status','pending')->get());
        $diteruskan = count(Abstrak::where('status','diteruskan')->get());
        $ditolak = count(Abstrak::where('status','ditolak')->get());
        $presenter = count(User::where('access','presenter')->get());
        $participant = count(User::where('access','participant')->get());
        return view('administrator/dashboard',[
            'log_login' =>  $log_login,
            'abstrak'   => $abstrak,
            'disetujui'   => $disetujui,
            'pending'   => $pending,
            'diteruskan'   => $diteruskan,
            'ditolak'   => $ditolak,
            'presenter'   => $presenter,
            'participant'   => $participant,
        ]);
    }
}
