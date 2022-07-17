<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(){
        $setting = Pengaturan::where('id',1)->first();
        return view('administrator/settings.index',compact('setting'));
    }
}
