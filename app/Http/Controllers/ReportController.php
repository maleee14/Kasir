<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Purchase;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function getData($awal, $akhir)
    {
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

        return compact('data', 'total_pendapatan');
    }

    public function index(Request $request)
    {
        $awal = $request->input('awal', date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))));
        $akhir = $request->input('akhir', date('Y-m-d'));

        $result = $this->getData($awal, $akhir);
        $data = $result['data'];
        $total_pendapatan = $result['total_pendapatan'];
        $tanggal_awal = $awal;

        return view('laporan.index', compact('data', 'total_pendapatan', 'tanggal_awal', 'akhir'));
    }

    public function filter(Request $request)
    {
        $awal = $request->input('awal');
        $akhir = $request->input('akhir');

        return redirect()->route('laporan.index', compact('awal', 'akhir'));
    }

    public function exportPdf(Request $request)
    {
        $awal = $request->input('awal', date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))));
        $akhir = $request->input('akhir', date('Y-m-d'));

        $result = $this->getData($awal, $akhir);
        $data = $result['data'];
        $total_pendapatan = $result['total_pendapatan'];
        $tanggal_awal = $awal;

        $pdf = Pdf::loadView('laporan.pdf', compact('data', 'total_pendapatan', 'tanggal_awal', 'akhir'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan Pendapatan-' . $tanggal_awal . ' -- ' . $akhir . '.pdf');
    }
}
