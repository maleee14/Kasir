<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Setting;
use Illuminate\Http\Request;

class SaleDetailController extends Controller
{
    public function index()
    {
        $produk = Product::orderBy('nama')->get();
        $member = Member::orderBy('nama')->get();
        $diskon =  Setting::first()->diskon ?? 0;

        if ($sale_id = session('id')) {
            $penjualan = Sale::find($sale_id);
            $memberSelected = $penjualan->member ?? new Member();

            $detail = SaleDetail::with('product')->where('sale_id', $sale_id)->get();
            $data = array();
            $total =  0;
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

            return view('penjualan_detail.index', compact('sale_id', 'produk', 'member', 'diskon', 'memberSelected', 'data', 'total', 'total_item'));
        }
    }

    public function store(Request $request)
    {
        $produk = Product::where('id', $request->product_id)->first();

        if (! $produk) {
            return response()->json('Data Gagal Disimpan', 400);;
        }

        $detail = new SaleDetail();
        $detail->sale_id = $request->sale_id;
        $detail->product_id = $produk->id;
        $detail->harga = $produk->harga_beli;
        $detail->jumlah = 1;
        $detail->subtotal = $produk->harga_beli;
        $detail->save();

        return response()->json('Data Berhasil Disimpan', 200);
    }

    public function destroy($id)
    {
        $detail = SaleDetail::find($id);
        $detail->delete();

        return redirect()->route('transaksi.index')->with('success', 'Produk Berhasil Dihapus');
    }

    public function update(Request $request, $id)
    {
        $detail = SaleDetail::find($id);
        $detail->jumlah = $request->jumlah;
        $detail->subtotal = $detail->harga * $request->jumlah;
        $detail->update();
    }
}
