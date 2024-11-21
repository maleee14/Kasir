<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function create()
    {
        $penjualan = new Sale();
        $penjualan->user_id = auth()->user()->id;
        $penjualan->member_id = null;
        $penjualan->total_item = 0;
        $penjualan->total_harga = 0;
        $penjualan->diskon = 0;
        $penjualan->bayar = 0;
        $penjualan->diterima = 0;
        $penjualan->save();

        session(['id' => $penjualan->id]);

        return redirect()->route('transaksi.index');
    }
}
