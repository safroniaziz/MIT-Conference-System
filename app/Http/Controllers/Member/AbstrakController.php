<?php

namespace App\Http\Controllers\Member;

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
        return view('member/abstrak.index',[
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
        return redirect()->route('member.abstrak')->with($notification);
    }

    public function add(){
        return view('member/abstrak.add');
    }

    public function edit($id){
        $abstrak = Abstrak::find($id);
        return view('member/abstrak.edit',[
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
            'thaun' =>  'required',
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
        return redirect()->route('member.abstrak')->with($notification);
    }

    public function update(Request $request, $id){
        $messages = [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute harus angka',
        ];
        $attributes = [
            'judul' =>  'required',
            'thaun' =>  'required',
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

        Abstrak::where('id',$id)->update([
            'judul'                   =>  $request->judul,
            'tahun_usulan'                     =>  $request->tahun_usulan,
            'abstrak'                  =>  $request->abstrak,
            'file_abstrak'                  =>  $model['file_abstrak'],
        ]);

        $notification = array(
            'message' => 'Berhasil, data abstrak berhasil diubah!',
            'alert-type' => 'success'
        );
        return redirect()->route('member.abstrak')->with($notification);
    }

    public function delete(Request $request){
        Abstrak::where('id',$request->id)->delete();
        $notification = array(
            'message' => 'Berhasil, data abstrak berhasil dihapus!',
            'alert-type' => 'success'
        );
        return redirect()->route('member.abstrak')->with($notification);
    }

    public function buktiPembayaran(Request $request){
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        $model['bukti_pembayaran'] = null;
        if ($request->hasFile('bukti_pembayaran')) {
            $model['bukti_pembayaran'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->bukti_pembayaran->getClientOriginalExtension();

            $request->bukti_pembayaran->move(public_path('/upload/bukti_pembayaran/'), $model['bukti_pembayaran']);
        }

        Abstrak::where('id',$request->id_kirim)->update([
            'bukti_pembayaran'   =>  $model['bukti_pembayaran'],
        ]);

        $notification = array(
            'message' => 'Berhasil, bukti pembayaran berhasil dikirim!',
            'alert-type' => 'success'
        );
        return redirect()->route('member.abstrak')->with($notification);
    }
}
