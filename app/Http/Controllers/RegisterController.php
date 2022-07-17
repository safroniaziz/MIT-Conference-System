<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function daftar(Request $request){
        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'full_name' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'access' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'username' => $request['username'],
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'password' => Hash::make($request['password']),
            'access' => $request->access,
            'address' => $request->address,
        ]);

        return redirect()->route('login');
    }
}
