<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profil($id)
    {
        $user= User::all()->where('id', $id);
        return view('Dashboard.users.show', compact('user'));
    }

    public function __contruct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request('search')) {
            $user= User::where('full_name', 'like', '%'.$request->search.'%')
                    ->orWhere('telepon', 'like', '%'.$request->search.'%')
                    ->orWhere('email', 'like', '%'.$request->search.'%')
                    ->orWhere('level', 'like', '%'.$request->search.'%')
                    ->orderby('full_name')
                    ->paginate(5)->withQueryString();

        } else {
            $user = User::select('*')->orderby('full_name')->paginate(5);
        }
        return view('Dashboard.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::all()->where('id', $id);
        $cek= auth()->user()->level;
        return view('Dashboard.users.editdata', compact('user'), compact('cek'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $vali=$request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'telepon' => 'required|min:10',
            'level' => 'required'
        ]);

        $vali['password'] = bcrypt($vali['password']);
        User::where('id', $id)
            ->update($vali);
        return redirect('/restauran/users')->with('success', 'Data berhasil di-update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect('/restauran/users')->with('success', 'Data berhasil dihapus!');
    }
}
