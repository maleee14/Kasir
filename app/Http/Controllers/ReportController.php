<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $awal = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $akhir = date('Y-m-d');

        $data = array();
        $pendapatan = 0;
        $total_pendapatan = 0;

        while (strtotime($awal) <= strtotime($akhir)) {
            $tanggal = $awal;
            $awal = date('Y-m-d', strtotime("+1 day", strtotime($awal)));

            $pengeluaran = Expenditure::where('created_at', 'LIKE', "%$tanggal%")->sum('nominal');
            $pembelian = Purchase::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');
            $penjualan = Sale::where('created_at', 'LIKE', "%$tanggal%")->sum('bayar');

            $pendapatan = $penjualan - $pembelian - $pengeluaran;
            $total_pendapatan += $pendapatan;

            $row = array();
            $row['tanggal'] = $tanggal;
            $row['pengeluaran'] = $pengeluaran;
            $row['pembelian'] = $pembelian;
            $row['penjualan'] = $penjualan;
            $row['pendapatan'] = $pendapatan;

            $data[] = $row;
        }

        return view('laporan.index', compact('data', 'total_pendapatan'));
    }
}
