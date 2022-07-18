<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        $abstraks = Abstrak::join('users', 'users.id','abstraks.user_id')
                            ->select('abstraks.id','full_name','proof_of_payment','status_payment')
                            ->where([
                            ['status_payment','dikirim'],
                            ['proof_of_payment','!=',""],
                            ['proof_of_payment','!=',null]
                            ])
                            ->orderBy('abstraks.created_at','desc')
                            ->get();
        return view('administrator/payment.index',[
            'abstraks'  => $abstraks,
            'setting'  => $setting,
        ]);
    }

    public function update(Request $request){
        Abstrak::where('id',$request->id)->update([
            'status_payment' => $request->verification
        ]);

        $notification = array(
            'message' => 'Payment Verification Successful!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.payment')->with($notification);
    }
}
