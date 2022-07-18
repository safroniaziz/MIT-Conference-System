<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Payment;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParticipantDashboardController extends Controller
{
    public function dashboard(){
        $setting = Pengaturan::where('id',1)->first();
        return view('participant/dashboard',compact('setting'));
    }

    public function payment(){
        $payment = Payment::select(DB::raw('sum(total) as total'))->where('user_id',Auth::user()->id)->first();
        $setting = Pengaturan::where('id',1)->first();
        return view('participant/payment.index',compact('payment','setting'));
    }

    public function paymentSend(Request $request){
        // return $request->all();
        $this->validate($request, [
            'proof_of_payment'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        $model['proof_of_payment'] = null;
        if ($request->hasFile('proof_of_payment')) {
            $model['proof_of_payment'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->proof_of_payment->getClientOriginalExtension();

            $request->proof_of_payment->move(public_path('/upload/proof_of_payment/'), $model['proof_of_payment']);
        }
        $abstrak = new Abstrak;
        $abstrak->user_id   = Auth::user()->id;
        $abstrak->proof_of_payment   = $model['proof_of_payment'];
        $abstrak->status_payment   = 'dikirim';
        $abstrak->save();

        $notification = array(
            'message' => 'paper file successfully uploaded!',
            'alert-type' => 'success'
        );
        return redirect()->route('participant.payment')->with($notification);
    }

    public function paymentUpdate(Request $request,$id){
        $this->validate($request, [
            'proof_of_payment'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $proof_of_payment = Abstrak::find($id);
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        if ($request->hasFile('proof_of_payment')){
            if (!$proof_of_payment->proof_of_payment == NULL){
                unlink(public_path('/upload/proof_of_payment/'.$proof_of_payment->proof_of_payment));
            }
            $model['proof_of_payment'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->proof_of_payment->getClientOriginalExtension();
            $request->proof_of_payment->move(public_path('/upload/proof_of_payment/'), $model['proof_of_payment']);
        }

        Abstrak::where('id',$id)->update([
            'proof_of_payment'  =>  $model['proof_of_payment'],
            'status_payment' => 'dikirim',
        ]);

        $notification = array(
            'message' => 'paper file successfully uploaded!',
            'alert-type' => 'success'
        );
        return redirect()->route('participant.payment')->with($notification);
    }

}
