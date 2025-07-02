<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Detail_Order;
use App\Models\Mennu;
use App\Models\Table;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Detail_Transaksi;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    { 
        if (request('search')) {
            $join= Transaksi::where('id_transaksi', 'like', '%'.$request->search.'%')
                            ->orWhere('tanggal', 'like', '%'.$request->search.'%')
                            ->orWhere('id_user', 'like', '%'.$request->search.'%')
                            ->orderby('id_transaksi')
                            ->paginate(5)->withQueryString();

        } else {
            $join= Transaksi::select('*')->paginate(5);
        }

        $trans= Transaksi::selectRaw('sum(total_bayar) as sum')->get();
        foreach ($trans as $key) {
            $sum= $key->sum;
        }

        return view('Dashboard.laporan.index', compact('join', 'sum'));
    }

    public function detail($id)
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
            $user= $item->id_user;
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

        $user2= User::all()->where('id', $user);
        
        foreach ($user2 as $key) {
            $name= $key->full_name;
        }

        return view('Dashboard.laporan.detail', 
        compact('join', 'name', 'detail', 'kembali', 'subtotal', 'tunai', 'total', 'diskon', 'no', 'jam', 'tgl'));
 
    }

    public function cetak(Request $request)
    {
        $a= new Carbon($request->awal);
        $awal= $a->isoFormat('D MMM Y');

        $b= new Carbon($request->akhir);
        $akhir= $b->isoFormat('D MMM Y');
        
        $tes= Transaksi::all()->whereBetween('tanggal', [$awal, $akhir])->sortby('tanggal');
        $sum= Transaksi::selectRaw('sum(total_bayar) as sum')->whereBetween('tanggal', [$awal, $akhir])->get();

        foreach ($sum as $key) {
            $total= $key->sum;
        }

        foreach ($tes as $key) {
            $lmao= $key->id_user;
        }

        $user= User::all()->where('id', $lmao);
        
        foreach ($user as $key) {
            $name= $key->full_name;
        }

        return view('Dashboard.laporan.cetak', compact('tes', 'awal', 'akhir', 'name', 'total'));
    }
}
