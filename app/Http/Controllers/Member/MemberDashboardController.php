<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberDashboardController extends Controller
{
    public function dashboard(){
        $log_login = DB::table('authentication_log')
                    ->select('login_at','logout_at','user_agent','ip_address')
                    ->where('authenticatable_id',Auth::user()->id)
                    ->where('login_successful',1)
                    ->orderBy('id','desc')
                    ->get();
        return view('member/dashboard',[
            'log_login' => $log_login,
        ]);
    }
}
