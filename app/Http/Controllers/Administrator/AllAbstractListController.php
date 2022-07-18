<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllAbstractListController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        $abstraks = Abstrak::join('users','users.id','abstraks.user_id')
                            ->select('judul','abstrak','abstraks.id','status','status_file','file_abstrak','abstraks.created_at','tahun_usulan','full_name')
                            ->whereNotNull('judul')
                            ->orderBy('abstraks.id','desc')
                            ->get();
        $subyek = Abstrak::select(DB::raw('count(id) as jumlah'), 'status')
                            ->whereNotNull('judul')
                            ->groupBy('status')->get();
        return view('administrator/abstrak.all',[
            'abstraks'  => $abstraks,
            'setting'  => $setting,
            'subyek'    => $subyek
        ]);
    }
}
