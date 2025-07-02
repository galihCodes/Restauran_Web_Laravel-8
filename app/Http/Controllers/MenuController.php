<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Mennu;
use App\Models\Dump;
use App\Models\User;

class MenuController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    /** get()=> paginate(5)
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $exist= Dump::all();

        if(request('search')){
            $makanan= Mennu::where('nama_menu', 'like', '%'.$req->search.'%', 'and', 'jenis_menu', 'makanan')
                    ->orWhere('stok', 'like', '%'.$req->search.'%')
                    ->orWhere('harga', 'like', '%'.$req->search.'%')
            ->get()->sortby('jenis_menu');
            $minuman= Mennu::where('nama_menu', 'like', '%'.$req->search.'%', 'and', 'jenis_menu', 'minuman')
                    ->orWhere('stok', 'like', '%'.$req->search.'%')
                    ->orWhere('harga', 'like', '%'.$req->search.'%')
            ->get()->sortby('jenis_menu');

        }else{
            $makanan= Mennu::all()->where('jenis_menu', 'makanan')->sortby('nama_menu');
            $minuman= Mennu::all()->where('jenis_menu', 'minuman')->sortby('nama_menu');
        } 
        
        $cek= Dump::all()->count();
        
        return view('Dashboard.layouts.all',
            compact('minuman', 'cek', 'makanan', 'exist'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.layouts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $vali= $request->validate([
            'nama_menu'=> 'required',
            'harga'=> 'required',
            'stok'=> 'required',
            'image'=> 'required|image',
            'jenis_menu'=> 'required'
        ]);

        // config->filesystem
        // php artisan storage:link -> terminal
        $vali['image'] = $request->file('image')->store('Menu-images');
        Mennu::create($vali);
        return redirect('/restauran/menu')->with('success', 'Menu baru telah ditambahkan!');;
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
        $tes= Mennu::all()->where('id_menu', $id); 
        // dd($tes);
        return view('Dashboard.layouts.edit', ['tes' => $tes]);
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
        $vali = $request->validate([
            'nama_menu' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'image' => 'image|required',
            'jenis_menu' => 'required'
        ]);

        $vali['image'] = $request->file('image')->store('Menu-images');

        Mennu::where('id_menu', $id)
            ->update($vali);

        return redirect('/restauran/menu')->with('success', 'Menu berhasil di-update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mennu::where('id_menu', $id)->delete();
        return redirect('/restauran/menu')->with('success', 'Menu berhasil dihapus!');
    }

    public function tambahstok(Request $request)
    {
        $data= Mennu::all()->where('nama_menu', $request->nama);
        
        if ($data->count()) {
            foreach ($data as $key) {
                $id= $key->id_menu;
                $stok= $key->stok + $request->stok;
            }
    
            Mennu::where('id_menu', $id)
                    ->update([
                        'stok' => $stok
                    ]);
    
            return redirect('/restauran/menu')->with('success', 'Stok Ditambahkan!');

        } else {
            return redirect('/restauran/menu')->with('success', 'Menu Tidak Ditemukan!');
        }
        
    }

    public function tambahstok2($id)
    {
        $data= Mennu::all()->where('id_menu', $id);
        return view('Dashboard.layouts.tambah', compact('data'));
    }

    public function prosesstok2(Request $request, $id)
    {
        $data= Mennu::all()->where('id_menu', $id);
        foreach ($data as $key) {
            $stok= $key->stok + $request->stok;
        }

        Mennu::where('id_menu', $id)
                ->update([
                    'stok' => $stok
                ]);

        return redirect('/restauran/menu')->with('success', 'Stok Berhasil Diubah!');
    }
}
