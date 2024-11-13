<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $kategori = Category::all();

        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|unique:categories,nama'
        ], [
            'nama.required' => 'Nama Kategori Tidak Boleh Kosong !!',
            'nama.unique' => 'Nama Kategori Sudah Ada !!',
        ]);

        Category::create([
            'nama' => $request->nama
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Ditambah');
    }

    public function edit(Category $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Category $kategori)
    {
        $request->validate([
            'nama' => 'required|min:3|unique:categories,nama'
        ], [
            'nama.required' => 'Nama Kategori Tidak Boleh Kosong !!',
            'nama.unique' => 'Nama Kategori Sudah Ada !!',
        ]);

        $kategori->nama = $request->nama;
        $kategori->update();

        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Diupdate');
    }

    public function destroy(Category $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori Berhasil Dihapus');
    }
}
