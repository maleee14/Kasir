<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $produk = Product::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        $kategori = Category::all();
        return view('produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'diskon' => 'required',
        ]);

        $randomCode = mt_rand(10000000, 99999999);

        Product::create([
            'category_id' => $request->category_id,
            'kode' => $randomCode,
            'nama' => $request->nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stock' => $request->stock,
            'diskon' => $request->diskon,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Ditambah');
    }

    public function edit(Product $produk)
    {
        $kategori = Category::all();
        return view('produk.edit', compact('produk', 'kategori'));
    }

    public function update(Request $request, Product $produk)
    {
        $request->validate([
            'category_id' => 'required',
            'nama' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'diskon' => 'required',
        ]);

        $produk->category_id = $request->category_id;
        $produk->nama = $request->nama;
        $produk->harga_beli = $request->harga_beli;
        $produk->harga_jual = $request->harga_jual;
        $produk->stock = $request->stock;
        $produk->diskon = $request->diskon;
        $produk->update();

        return redirect()->route('produk.index')->with('success', 'Produk Berhasil Diupdate');
    }

    public function destroy(Product $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('delete', 'Produk Berhasil Dihapus');
    }
}
