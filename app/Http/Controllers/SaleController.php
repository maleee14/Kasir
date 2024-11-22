<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $penjualan = Sale::orderBy('created_at')->get();

        return view('penjualan.index', compact('penjualan'));
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

    public function store(Request $request)
    {
        $penjualan = Sale::findOrFail($request->input('sale_id'));
        $penjualan->member_id = $request->member_id;
        $penjualan->total_item = $request->total_item;
        $penjualan->total_harga = $request->total_harga;
        $penjualan->diskon = $request->diskon;
        $penjualan->bayar = $request->bayar;
        $penjualan->diterima = $request->diterima;
        $penjualan->update();

        $detail = SaleDetail::where('sale_id', $penjualan->id)->get();
        foreach ($detail as $item) {
            $produk = Product::find($item->product_id);
            $produk->stock -= $item->jumlah;
            $produk->update();
        }

        return redirect()->route('penjualan.index')->with('success', 'Transaksi Penjualan Berhasil');
    }

    public function destroy($id)
    {
        $penjualan = Sale::find($id);
        $penjualan->delete();

        return redirect()->route('penjualan.index')->with('success', 'Data Penjualan Berhasil Dihapus');
    }

    public function show($id)
    {
        $detail = SaleDetail::where('sale_id', $id)->get();
        $penjualan = Sale::find($id);

        return view('penjualan.detail', compact('detail', 'penjualan'));
    }
}
