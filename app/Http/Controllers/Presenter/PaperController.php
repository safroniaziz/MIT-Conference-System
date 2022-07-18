<?php

namespace App\Http\Controllers\Presenter;

use App\Http\Controllers\Controller;
use App\Models\Abstrak;
use App\Models\Paper;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaperController extends Controller
{
    public function index(){
        $papers = Abstrak::where([
            ['user_id',Auth::user()->id],
            ['proof_of_payment','!=',""],
            ['proof_of_payment','!=',null],
            ['status_payment','!=',"pending"],
            ['status_payment','!=',null],
        ])->get();
        $setting = Pengaturan::where('id',1)->first();
        return view('presenter/paper.index',[
            'papers'  => $papers,
            'setting' => $setting,
        ]);
    }

    public function uploadPaper(Request $request, $abstrak_id){
        // return $request->all();
        $this->validate($request, [
            'file_paper'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        $model['file_paper'] = null;
        if ($request->hasFile('file_paper')) {
            $model['file_paper'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_paper->getClientOriginalExtension();

            $request->file_paper->move(public_path('/upload/file_paper/'), $model['file_paper']);
        }
        Abstrak::where('id',$abstrak_id)->update([
            'file_paper'   =>  $model['file_paper'],
        ]);

        $notification = array(
            'message' => 'paper file successfully uploaded!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.paper')->with($notification);
    }

    public function ubahUploadPaper(Request $request, $abstrak_id){
        $this->validate($request, [
            'file_paper'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);
        // return $request->all();
        $file_paper = Abstrak::find($abstrak_id);
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        if ($request->hasFile('file_paper')){
            if (!$file_paper->file_paper == NULL){
                unlink(public_path('/upload/file_paper/'.$file_paper->file_paper));
            }
            $model['file_paper'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_paper->getClientOriginalExtension();
            $request->file_paper->move(public_path('/upload/file_paper/'), $model['file_paper']);
        }

        Abstrak::where('id',$abstrak_id)->update([
            'file_paper'   =>  $model['file_paper'],
        ]);

        $notification = array(
            'message' => 'paper file successfully updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.paper')->with($notification);
    }

    public function uploadPresentasi(Request $request, $abstrak_id){
        // return $request->all();
        $this->validate($request, [
            'file_presentasi'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        $model['file_presentasi'] = null;
        if ($request->hasFile('file_presentasi')) {
            $model['file_presentasi'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_presentasi->getClientOriginalExtension();

            $request->file_presentasi->move(public_path('/upload/file_presentasi/'), $model['file_presentasi']);
        }
        Abstrak::where('id',$abstrak_id)->update([
            'file_presentasi'   =>  $model['file_presentasi'],
        ]);

        $notification = array(
            'message' => 'Presentation file successfully uploaded!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.paper')->with($notification);
    }

    public function ubahUploadPresentasi(Request $request, $abstrak_id){
        // return $request->all();
        $this->validate($request, [
            'file_presentasi'   =>  'required|mimes:jpg,jpeg,png,pdf|max:1024',
        ]);

        $file_presentasi = Abstrak::find($abstrak_id);
        $model = $request->all();
        $slug_user = Str::slug(Auth::user()->full_name);
        if ($request->hasFile('file_presentasi')){
            if (!$file_presentasi->file_presentasi == NULL){
                unlink(public_path('/upload/file_presentasi/'.$file_presentasi->file_presentasi));
            }
            $model['file_presentasi'] = $slug_user.'-'.Auth::user()->id.uniqid().'.'.$request->file_presentasi->getClientOriginalExtension();
            $request->file_presentasi->move(public_path('/upload/file_presentasi/'), $model['file_presentasi']);
        }

        Abstrak::where('id',$abstrak_id)->update([
            'file_presentasi'   =>  $model['file_presentasi'],
        ]);

        $notification = array(
            'message' => 'Presentation file successfully updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.paper')->with($notification);
    }

    public function changeStatus($abstrak_id){
        Abstrak::where('id',$abstrak_id)->update([
            'status_file'   =>  'dikirim',
        ]);

        $notification = array(
            'message' => 'File has been sent!',
            'alert-type' => 'success'
        );
        return redirect()->route('presenter.paper')->with($notification);
    }
}
