<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dump;
use App\Models\Mennu;

class LoginController extends Controller
{
    // public function __contruct()
    // {
    //     $this->middleware('guest');
    // }

    public function index()
    {
        return view('Home.login');
    }

    public function auth(Request $request)
    {
        // dd($request);
        $credential = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/restauran');
            // return redirect('/restauran');
        }
        
        return back()->with('failed', 'Login Gagal!');

    }


    public function logout(Request $request)
    {
        $join= DB::table('dumps')
                ->join('menues', 'dumps.id_menu', '=', 'menues.id_menu')
                ->select('dumps.id_menu', 'dumps.id', 'dumps.jumlah', 'menues.stok')
                ->get();
        
        foreach ($join as $key) {
            $id_menu= $key->id_menu;
            $hasil= $key->jumlah + $key->stok;
            Mennu::where('id_menu', $id_menu)
                    ->update([
                        'stok' => $hasil
                    ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Dump::truncate();
        return redirect('/form');
    }
}
