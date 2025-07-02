<?php

//count()->pengganti->exist atau (jika ada)->atau true (1) : false(0)
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mennu;
use App\Models\Dump;
use App\Models\Table;
use App\Models\Detail_Order;
use App\Models\Order;

class CartController extends Controller
{
    public function tambahcart(Request $request, $id){
        $data= Mennu::all()->where('id_menu',$id);
        $jumlah= $request->jumlah;

        foreach ($data as $tes){

        $stok= $tes->stok;
        $sisa= $stok-$jumlah;
        $total= $jumlah*$tes->harga;
        Dump::create([
            'id_menu' => $id,
            'nama_menu' => $tes->nama_menu,
            'jumlah' => $jumlah,
            'total' => $total,
            'jenis_menu' => $tes->jenis_menu
        ]);

        Mennu::where('id_menu', $id)
                ->update([
                    'stok' => $sisa
                ]);

        return redirect()->back();
        }
        
    }

    public function proses()
    {
        $dump= Dump::all();
        $date= \Carbon\Carbon::now()->isoFormat('D MMM Y');
        $meja= Table::all()->sortby('Nomor_Meja');
        $total= Dump::sum('total');

        $join= DB::table('dumps')
                ->join('menues', 'dumps.id_menu', '=', 'menues.id_menu')
                ->select('dumps.*', 'menues.nama_menu', 'menues.harga', 'menues.image', 'menues.jenis_menu')
                ->orderby('menues.jenis_menu')
                ->get();


        return view('Dashboard.Orders.proses', compact('dump', 'meja', 'date', 'join', 'total'));
    }

    public function sistem(Request $request)
    {
        $dump= Dump::all();
        $order= Order::all();
        $meja= Order::where('no_meja', $request->nomor_meja)->get();
        $total= Dump::sum('total');
        $date= \Carbon\Carbon::now()->isoFormat('D MMM Y');

        foreach ($meja as $item) {
    
            $status= $item->status;
        }

        if ($order->count() == 0 || $meja->count() == 0) {
            Order::create([
                'no_meja' => $request->nomor_meja,
                'tanggal' => $date,
                'total' => $total,
                'user_id' => auth()->user()->id,
                'status' => 'sedang dimasak'
            ]);
    
            $tes= Order::select('id_order')->first()->get();
            foreach ($tes as $item) {
    
                $t= $item->id_order;
            }
            
            foreach ($dump as $key) {
                $tes= Detail_Order::create([
                    'id_order' => $t,
                    'id_menu' => $key->id_menu,
                    'nama_menu' => $key->nama_menu,
                    'jumlah' => $key->jumlah,
                    'subtotal' => $key->total,
                    'jenis_menu' => $key->jenis_menu
                ]);
            }
            Table::where('nomor_meja', $request->nomor_meja)
                    ->update([
                        'status' => 'Sedang Dipakai'
                    ]);
        }
        
        elseif ($status !== 'terbayar') {
            $meja= Order::where('no_meja', $request->nomor_meja)->get();

            foreach ($meja as $key) {
                $t= $key->id_order;
                $total1= $key->total;
                $total2= $total1 + $total;
            }
            
            Order::where('id_order', $t)
                    ->update([
                        'status' => 'sedang dimasak',
                        'total' => $total2
                    ]);
            
            foreach ($dump as $key) {
                $tes= Detail_Order::create([
                    'id_order' => $t,
                    'id_menu' => $key->id_menu,
                    'nama_menu' => $key->nama_menu,
                    'jumlah' => $key->jumlah,
                    'subtotal' => $key->total,
                    'jenis_menu' => $key->jenis_menu
                ]);
            }
            Table::where('nomor_meja', $request->nomor_meja)
                    ->update([
                        'status' => 'Sedang Dipakai'
                    ]);
            
        } elseif ($status == 'terbayar') {
            Order::create([
                'no_meja' => $request->nomor_meja,
                'tanggal' => $date,
                'total' => $total,
                'user_id' => auth()->user()->id,
                'status' => 'sedang dimasak'
            ]);
    
            $tes= Order::select('id_order')->first()->get();
            foreach ($tes as $item) {
    
                $t= $item->id_order;
            }
            
            foreach ($dump as $key) {
                $tes= Detail_Order::create([
                    'id_order' => $t,
                    'id_menu' => $key->id_menu,
                    'nama_menu' => $key->nama_menu,
                    'jumlah' => $key->jumlah,
                    'subtotal' => $key->total,
                    'jenis_menu' => $key->jenis_menu
                ]);
            }

            Table::where('nomor_meja', $request->nomor_meja)
                    ->update([
                        'status' => 'Sedang Dipakai'
                    ]);
        }
        
        Dump::truncate();
        return redirect('/restauran/menu');
    }

    public function hapus($id)
    {
        $join= DB::table('dumps')
                ->join('menues', 'dumps.id_menu', '=', 'menues.id_menu')
                ->select('dumps.id', 'dumps.jumlah', 'menues.stok', 'menues.id_menu')
                ->where('id', $id)
                ->get();
        
        foreach ($join as $key) {
            $id_menu= $key->id_menu;
            $hasil= $key->jumlah + $key->stok;
        }

        Mennu::where('id_menu', $id_menu)
                ->update([
                    'stok' => $hasil
                ]);
        
        Dump::where('id',$id)->delete();
        return redirect('/restauran/orders/proses');
        
    }

    public function batal()
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

        Dump::truncate();
        return redirect('/restauran/menu')->with('success', 'Pesanan Dibatalkan!');
    }
}
