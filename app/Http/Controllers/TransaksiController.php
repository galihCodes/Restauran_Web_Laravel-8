<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Detail_Order;
use App\Models\Mennu;
use App\Models\Table;
use App\Models\Transaksi;
use App\Models\Detail_Transaksi;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        if (request('search')) {
            $order= Order::where('no_meja', 'like', '%'.$request->search.'%')
                           ->orWhere('id_order', 'like', '%'.$request->search.'%')
                           ->orWhere('tanggal', 'like', '%'.$request->search.'%')
                           ->orWhere('user_id', 'like', '%'.$request->search.'%')
                           ->orderby('status')
                           ->paginate(5)->withQueryString();
        }else{
            $order= Order::select('*')->orderby('status')->paginate(5);
        }

        $ex= Order::where('status', 'sudah diantar')
                    ->orWhere('status', 'selesai')
                    ->orWhere('status', 'terbayar')
                    ->paginate(5);

        return view('Dashboard.pembayaran.index', compact('order', 'ex'));
    }

    public function bayar($id)
    {
        $join= Order::all()->where('id_order', $id);
        foreach ($join as $key) {
            $total= $key->total;
        }

        foreach ($join as $key) {
            // $detail= Detail_Order::all()->where('id_order', $key->id_order)->sortby('jenis_menu');

            $detail= Detail_Order::selectRaw('nama_menu, sum(jumlah) as sum, jenis_menu')
                ->where('id_order', $key->id_order)
                ->orderby('jenis_menu')
                ->groupBy('nama_menu', 'jenis_menu')
                ->get();

        }
                
        return view('Dashboard.pembayaran.proses', compact('join', 'detail', 'total'));
    }

    public function struk(Request $request, $id)
    {
        $tes= Order::where('id_order', $id)->get();
        foreach ($tes as $key) {
            $cost= $key->total;
            $bayar= $request->tunai;
            $meja= $key->no_meja;
        }

        if ($bayar >= $cost) {
            $subtotal= $cost;
            $tunai= $request->tunai;
            $diskon= 0;
            $total= $subtotal-$diskon;
            $kembali= $tunai-$total;
            $join= Order::all()->where('id_order', $id);
            
            foreach ($join as $key) {
                $detail= Detail_Order::selectRaw('nama_menu, sum(jumlah) as sum, jenis_menu, subtotal')
                    ->where('id_order', $key->id_order)
                    ->orderby('jenis_menu')
                    ->groupBy('nama_menu', 'jenis_menu', 'subtotal')
                    ->get();

                $no= $key->no_meja;
            }
        }
        Table::where('nomor_meja', $meja)
                ->update([
                    'status' => 'Kosong'
                ]);

        Order::where('id_order', $id)
                ->update([
                    'status' => 'terbayar',
                    'tanggal' => now()->isoFormat('D MMM Y')
                ]);

        Transaksi::create([
                'id_user' => auth()->user()->id,
                'id_order' => $id,
                'jam' => now()->addHours(7)->ToTimeString(),
                'tanggal' => now()->isoFormat('D MMM Y'),
                'total_bayar' => $total
        ]);

        $jam= now()->addHours(7)->ToTimeString();
        $tgl= now()->isoFormat('D MMM Y');
        $id= Transaksi::max('id_transaksi');

        Detail_Transaksi::create([
            'id_transaksi' => $id,
            'sub_total' => $subtotal,
            'diskon' => $diskon,
            'total' => $total,
            'tunai' => $tunai,
            'kembalian' => $kembali
        ]);

        return view('Dashboard.pembayaran.struk', 
        compact('join', 'detail', 'kembali', 'subtotal', 'tunai', 'total', 'diskon', 'no', 'jam', 'tgl'));
    }
        
    public function struk2($id)
    {
        $tes= Order::where('id_order', $id)->get();
        foreach ($tes as $key) {
            $cost= $key->total;
            $meja= $key->no_meja;
        }

        $transaksi= Transaksi::all()->where('id_order', $id);   
        
        foreach ($transaksi as $item) {
            $id_transaksi= $item->id_transaksi;
            $jam= $item->jam;
            $tgl= $item->tanggal;
        }

        $detail2= Detail_Transaksi::all()->where('id_transaksi', $id_transaksi);
        
        foreach ($detail2 as $key) {
            $subtotal= $key->sub_total;
            $tunai= $key->tunai;
            $diskon= $key->diskon;
            $total= $key->total;
            $kembali= $key->kembalian;
        }

        $join= Order::all()->where('id_order', $id);
        
        foreach ($join as $key) {
            $detail= Detail_Order::selectRaw('nama_menu, sum(jumlah) as sum, jenis_menu, subtotal')
                ->where('id_order', $key->id_order)
                ->orderby('jenis_menu')
                ->groupBy('nama_menu', 'jenis_menu', 'subtotal')
                ->get();

            $no= $key->no_meja;
        }


        return view('Dashboard.pembayaran.struk', 
        compact('join', 'detail', 'kembali', 'subtotal', 'tunai', 'total', 'diskon', 'no', 'jam', 'tgl'));
 
    }
}
