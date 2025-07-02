<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Mennu;
use App\Models\Table;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $count= Order::where('status', 'sedang dimasak')->count();

        if (request('search')) {
            $order= Order::where('no_meja', 'like', '%'.$request->search.'%')
                           ->orWhere('id_order', 'like', '%'.$request->search.'%')
                           ->orWhere('tanggal', 'like', '%'.$request->search.'%')
                           ->orWhere('user_id', 'like', '%'.$request->search.'%')
                           ->orderby('id_order')
                           ->paginate(5)->withQueryString();
        }else{
            $order= Order::select('*')->where('status', 'sedang dimasak')->paginate(5);
        }

        return view('Dashboard.Orders.index', compact('order', 'count'));
    }

    public function deliver(Request $request)
    {
        if (request('search')) {
            $order= Order::where('no_meja', 'like', '%'.$request->search.'%')
                           ->orWhere('id_order', 'like', '%'.$request->search.'%', 'and','status', 'sudah diantar')
                           ->orWhere('tanggal', 'like', '%'.$request->search.'%', 'and','status', 'sudah diantar')
                           ->orWhere('user_id', 'like', '%'.$request->search.'%', 'and','status', 'sudah diantar')
                           ->orderby('id_order')
                           ->paginate(5)->withQueryString();
        }else{
            $order= Order::select('*')->where('status', 'sudah diantar')->paginate(5);
        }
        
        return view('Dashboard.Orders.deliv', compact('order'));
    }

    public function proses($id)
    {
        Order::where('id_order', $id)
                ->update([
                    'status' => 'sudah diantar'
                ]);
        
        return redirect()->back();
    }

    public function hidden($id)
    {
        Order::where('id_order', $id)
                ->update([
                    'status' => 'selesai'
                ]);
        
        return redirect()->back();
    }

    public function saveall()
    {
        $order= Order::all()->where('status', 'sudah diantar');

        foreach ($order as $key) {

            $a= Order::where('id_order', $key->id_order)
                ->update([
                    'status' => 'selesai'
                ]);
        }

        return redirect()->back();
    }
}
