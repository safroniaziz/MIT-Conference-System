<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParticipantDashboardController extends Controller
{
    public function dashboard(){
        return view('participant/dashboard');
    }

    public function payment(){
        $payment = Payment::select(DB::raw('sum(total) as total'))->where('user_id',Auth::user()->id)->first();
        return view('participant/payment.index',compact('payment'));
    }
}
