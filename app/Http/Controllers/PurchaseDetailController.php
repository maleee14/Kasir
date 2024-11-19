<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    public function index()
    {
        $purchase_id = session('id');
        $produk = Product::orderBy('nama')->get();
        $supplier = Supplier::find(session('supplier_id'));
        $diskon = Purchase::find($purchase_id)->diskon ?? 0;

        if (! $supplier) {
            abort(404);
        }

        $detail = PurchaseDetail::with('product')->where('purchase_id', $purchase_id)->get();
        $data = array();
        $total = 0;
        $total_item = 0;

        foreach ($detail as $item) {
            $data[] = [
                'id' => $item->id,
                'kode' => $item->product['kode'],
                'nama' => $item->product['nama'],
                'harga' => $item->harga,
                'jumlah' => $item->jumlah,
                'subtotal' => $item->harga * $item->jumlah
            ];

            $total += $item->harga * $item->jumlah;
            $total_item += $item->jumlah;
        }

        return view('pembelian_detail.index', compact('purchase_id', 'produk', 'supplier', 'diskon', 'data', 'total', 'total_item'));
    }

    public function store(Request $request)
    {
        $produk = Product::where('id', $request->product_id)->first();

        if (! $produk) {
            return response()->json('Data Gagal Disimpan', 400);;
        }

        $detail = new PurchaseDetail();
        $detail->purchase_id = $request->purchase_id;
        $detail->product_id = $produk->id;
        $detail->harga = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function update(Request $request, $id)
    {
        $detail = PurchaseDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga * $request->jumlah;
        $detail->update();
    }

    public function destroy($id)
    {
        $detail = PurchaseDetail::find($id);
        $detail->delete();
        return redirect()->route('pembelian-detail.index')->with('success', 'Produk Berhasil Dihapus');
    }
}
