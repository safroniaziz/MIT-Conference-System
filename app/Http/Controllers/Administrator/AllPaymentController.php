<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllPaymentController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        $abstraks = Abstrak::join('users', 'users.id','abstraks.user_id')
                            ->select('abstraks.id','access','full_name','proof_of_payment','status_payment')
                            ->where([
                            ['proof_of_payment','!=',""],
                            ['proof_of_payment','!=',null]
                            ])
                            ->orderBy('abstraks.created_at','desc')
                            ->get();
        $subyek = Abstrak::select(DB::raw('count(id) as jumlah'), 'status_payment')
                            ->groupBy('status_payment')->get();
        $subyek2 = Abstrak::join('users','users.id','abstraks.user_id')
                            ->select(DB::raw('count(abstraks.id) as jumlah'), 'access')
                            ->groupBy('access')->get();
        return view('administrator/proof.index',[
            'abstraks'  => $abstraks,
            'setting'  => $setting,
            'subyek'  => $subyek,
            'subyek2'  => $subyek2,
        ]);
    }

}
