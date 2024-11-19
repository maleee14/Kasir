<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $pembelian = Purchase::orderBy('created_at', 'desc')->get();
        $supplier = Supplier::orderBy('nama', 'asc')->get();
        return view('pembelian.index', compact('supplier', 'pembelian'));
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

        return redirect()->route('pembelian-detail.index');
    }

    public function store(Request $request)
    {
        $pembelian = Purchase::findOrFail($request->input('purchase_id'));
        $pembelian->total_item = $request->total_item;
        $pembelian->total_harga = $request->total_harga;
        $pembelian->diskon = $request->diskon;
        $pembelian->bayar = $request->bayar;
        $pembelian->update();

        $detail = PurchaseDetail::where('purchase_id', $pembelian->id)->get();
        foreach ($detail as $item) {
            $produk = Product::find($item->product_id);
            $produk->stock += $item->jumlah;
            $produk->update();
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian Berhasil');
    }

    public function destroy(Purchase $pembelian)
    {
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Data Pembelian Berhasil Dihapus');
    }
}
