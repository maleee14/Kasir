<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    public function index()
    {
        $pengeluaran = Expenditure::all();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required',
        ]);

        Expenditure::create([
            'deskripsi' => $request->deskripsi,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran Berhasil Ditambah');
    }

    public function edit(Expenditure $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Expenditure $pengeluaran)
    {
        $request->validate([
            'deskripsi' => 'required',
            'nominal' => 'required',
        ]);

        $pengeluaran->deskripsi = $request->deskripsi;
        $pengeluaran->nominal = $request->nominal;
        $pengeluaran->update();

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran Berhasil Diupdate');
    }

    public function destroy(Expenditure $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('delete', 'Pengeluaran Berhasil Dihapus');
    }
}
