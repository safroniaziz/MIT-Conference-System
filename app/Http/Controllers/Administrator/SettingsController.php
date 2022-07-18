<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        return view('administrator/settings.index',compact('setting'));
    }

    public function update(Request $request, $id){
        $attributes = [
            'nama_app'   =>  'Application Name',
            'singkatan'   =>  'Application Short Name',
            'keterangan_app'   =>  ' Application Description',
            'biaya_presenter'   =>  'Presenter Price ',
            'biaya_participant'   =>  'Participant Price ',
            'bank'   =>  'Bank Name ',
            'norek'   =>  'Bank Account Number',
            'terakhir_transfer' =>  'Payment Deadline ',
        ];
        $this->validate($request, [
            'logo'   =>  'mimes:jpg,jpeg,png|max:500',
            'nama_app'  =>  'required',
            'singkatan' =>  'required',
            'keterangan_app'    =>  'required',
            'biaya_presenter'   =>  'required',
            'biaya_participant' =>  'required',
            'bank' =>  'required',
            'norek' =>  'required',
            'terakhir_transfer' =>  'required',
        ],$attributes);

        $logo = Pengaturan::find($id);
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        if ($request->hasFile('logo')){
            if (!$logo->logo == NULL){
                unlink(public_path('/upload/aplication_logo/'.$logo->logo));
            }
            $model['logo'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('/upload/aplication_logo/'), $model['logo']);
        }

        if ($request->hasFile('logo')) {
            Pengaturan::where('id',$id)->update([
                'nama_app'  => $request->nama_app,
                'singkatan'  => $request->singkatan,
                'keterangan_app'  => $request->keterangan_app,
                'biaya_presenter'  => $request->biaya_presenter,
                'biaya_participant'  => $request->biaya_participant,
                'bank'  => $request->bank,
                'norek'  => $request->norek,
                'terakhir_transfer' =>  $request->terakhir_transfer,
                'logo_app'          => $model['logo'],
            ]);
        }else {
            Pengaturan::where('id',$id)->update([
                'nama_app'  => $request->nama_app,
                'singkatan'  => $request->singkatan,
                'keterangan_app'  => $request->keterangan_app,
                'biaya_presenter'  => $request->biaya_presenter,
                'biaya_participant'  => $request->biaya_participant,
                'bank'  => $request->bank,
                'norek'  => $request->norek,
                'terakhir_transfer' =>  $request->terakhir_transfer,
            ]);
        }

        $notification = array(
            'message' => 'Application settings successfully updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('administrator.settings')->with($notification);
    }
}
