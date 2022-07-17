<?php

namespace App\Http\Controllers\Presenter;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AbstrakController extends Controller
{
    public function index(){
        $abstraks = Abstrak::where('user_id',Auth::user()->id)->get();
        return view('presenter/abstrak.index',[
            'abstraks'  => $abstraks,
        ]);
    }

    public function usulkan($id){
        $abstrak = Abstrak::find($id);
        $abstrak->status = "diteruskan";
        $abstrak->update();
        $notification = array(
            'message' => 'Berhasil, usulan abstrak berhasil diteruskan!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.abstrak')->with($notification);
    }

    public function add(){
        return view('presenter/abstrak.add');
    }

    public function edit($id){
        $abstrak = Abstrak::find($id);
        return view('presenter/abstrak.edit',[
            'abstrak' => $abstrak
        ]);
    }

    public function post(Request $request){
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus angka',
        ];
        $attributes = [
            'judul' =>  'required',
            'tahun_usulan' =>  'required',
            'file_abstrak'   =>  'mimes:pdf|max:1000',
            'abstrak' =>  'required',
            'status_file'   =>  'pending'
        ];
        $this->validate($request, [
        ],$messages,$attributes);

        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        $model['file_abstrak'] = null;
        if ($request->hasFile('file_abstrak')) {
            $model['file_abstrak'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_abstrak->getClientOriginalExtension();

            $request->file_abstrak->move(public_path('/upload/file_abstrak/'), $model['file_abstrak']);
        }

        Abstrak::create([
            'judul'          =>  $request->judul,
            'tahun_usulan'   =>  $request->tahun_usulan,
            'abstrak'        =>  $request->abstrak,
            'file_abstrak'   =>  $model['file_abstrak'],
            'status'         =>  'pending',
            'user_id'        =>  Auth::user()->id,
        ]);

        $notification = array(
            'message' => 'Berhasil, data abstrak berhasil ditambahkan!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.abstrak')->with($notification);
    }

    public function update(Request $request, $id){
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus angka',
        ];
        $attributes = [
            'judul' =>  'required',
            'tahun_usulan' =>  'required',
            'file_abstrak'   =>  'mimes:pdf|max:1000',
            'abstrak' =>  'required',
        ];
        $this->validate($request, [
        ],$messages,$attributes);

        $model = $request->all();

        $slug_user = Str::slug(Auth::user()->full_name);
        $model['file_abstrak'] = null;

        if ($request->hasFile('file_abstrak')) {
            $model['file_abstrak'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_abstrak->getClientOriginalExtension();

            $request->file_abstrak->move(public_path('/upload/file_abstrak/'), $model['file_abstrak']);
        }

        if ($request->hasFile('file_abstrak')) {
            Abstrak::where('id',$id)->update([
                'judul'                   =>  $request->judul,
                'tahun_usulan'                     =>  $request->tahun_usulan,
                'abstrak'                  =>  $request->abstrak,
                'file_abstrak'                  =>  $model['file_abstrak'],
            ]);
        }else {
            Abstrak::where('id',$id)->update([
                'judul'                   =>  $request->judul,
                'tahun_usulan'                     =>  $request->tahun_usulan,
                'abstrak'                  =>  $request->abstrak,
            ]);
        }
        $notification = array(
            'message' => 'Berhasil, data abstrak berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.abstrak')->with($notification);
    }

    public function delete(Request $request){
        Abstrak::where('id',$request->id)->delete();
        $notification = array(
            'message' => 'Berhasil, data abstrak berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.abstrak')->with($notification);
    }

    public function buktiPembayaran(Request $request){
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
        Abstrak::where('id',$request->id_kirim)->update([
            'proof_of_payment'   =>  $model['proof_of_payment'],
        ]);

        $notification = array(
            'message' => 'Berhasil, bukti pembayaran berhasil dikirim!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.abstrak')->with($notification);
    }
}
