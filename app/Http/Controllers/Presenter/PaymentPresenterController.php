<?php

namespace App\Http\Controllers\Presenter;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentPresenterController extends Controller
{
    public function index(){
        $papers = Abstrak::where([
            ['user_id',Auth::user()->id],
        ])->get();
        $setting = Pengaturan::where('id',1)->first();
        return view('presenter/payment.index',[
            'papers'  => $papers,
            'setting' => $setting,
        ]);
    }
}
