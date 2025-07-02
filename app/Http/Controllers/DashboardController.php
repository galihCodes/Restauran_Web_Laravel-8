<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Detail_Order;
use App\Models\Order;
use App\Models\Mennu;
use App\Models\Table;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $user= User::all();
        $table= Table::all()->count();
        $order= Order::all()->where('status', 'sedang dimasak')->count();
        $detail= Detail_Order::all()->sum('jumlah');
        $menu= Mennu::all()->count();

        return view('Dashboard.index', compact('user', 'order', 'detail', 'menu', 'table'));
    }
}
