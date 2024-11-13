<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $supplier = Supplier::orderBy('nama', 'asc')->get();
        return view('pembelian.index', compact('supplier'));
    }

    public function create($id)
    {
        $pembelian = new Purchase();
        $pembelian->supplier_id = $id;
        $pembelian->total_item = 0;
        $pembelian->total_harga = 0;
        $pembelian->diskon = 0;
        $pembelian->bayar = 0;
        $pembelian->save();

        session(['id' => $pembelian->id]);
        session(['supplier_id' => $pembelian->supplier_id]);
    }
}
