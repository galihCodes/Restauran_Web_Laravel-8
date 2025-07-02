<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request('search')) {
           if (auth()->user()->level == 'kasir') {
                $data= Table::where('Nomor_Meja', 'like', '%'.$request->search.'%')
                ->orWhere('status', 'like', '%'.$request->search.'%')
                ->orderby('Nomor_Meja')
                ->paginate(5)->withQueryString();

           } else {
                $data= Table::where('Nomor_Meja', 'like', '%'.$request->search.'%')
                ->orWhere('Keterangan', 'like', '%'.$request->search.'%')
                ->orderby('Nomor_Meja')
                ->paginate(5)->withQueryString();
           }
           
        } else {
            $data= Table::select('*')->orderby('Nomor_meja')->paginate(5);
        }
        
        return view('Dashboard.tables.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Dashboard.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $add= $request->validate([
            'Nomor_Meja' => 'required|unique:tables,Nomor_meja',
            'Keterangan' => 'required'
        ]);

        if ($add = true) {
            Table::create([
                'Nomor_Meja' => $request->Nomor_Meja,
                'Keterangan' => $request->Keterangan,
                'status' => 'Kosong'
            ]);
        }

        return redirect('/restauran/table')->with('success', 'Data Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data= Table::all()->where('id_meja', $id);
        return view('Dashboard.tables.edit', compact('data'));
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
        $edit= $request->validate([
            'Nomor_Meja' => 'required|unique:tables,id_meja,except,Nomor_Meja',
            'Keterangan' => 'required'
        ]);
        Table::where('id_meja', $id)->update($edit);

        return redirect('restauran/table')->with('success', 'Data Berhasil Di-Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Table::where('id_meja', $id)->delete();
        return redirect('/restauran/table')->with('success', 'Data Berhasil Dihapus!');
    }
}
