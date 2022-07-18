<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiAbstrakController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        $abstraks = Abstrak::where('status','diteruskan')->get();
        return view('administrator/abstrak.index',[
            'abstraks'  => $abstraks,
            'setting'  => $setting,
        ]);
    }

    public function update(Request $request){
        Abstrak::where('id',$request->id)->update([
            'status' => $request->verification
        ]);

        $notification = array(
            'message' => 'Abstract Verification Successful!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.abs_verif')->with($notification);
    }
}
