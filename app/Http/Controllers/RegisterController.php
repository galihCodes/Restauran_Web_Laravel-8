<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        // dd($request);
        $vali=$request->validate([
            'full_name'=> 'required',
            'username'=> 'required|unique:users,username',
            'email'=> 'required|email',
            'password'=> 'required',
            'telepon'=> 'required|min:10',
            'level'=> 'required'
        ]);
        $vali['password']=bcrypt($vali['password']);
        User::create($vali);
        return redirect('/restauran/users')->with('success', 'Registrasi berhasil!');
    }
}
