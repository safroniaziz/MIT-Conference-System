<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaperController extends Controller
{
    public function index(){
        $abstraks = Abstrak::where('status','disetujui')
                            ->where('bukti_pembayaran','!=',null)
                            ->where('user_id',Auth::user()->id)->get();
        return view('member/paper.index',[
            'abstraks'  => $abstraks,
        ]);
    }
}
