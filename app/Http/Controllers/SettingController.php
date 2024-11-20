<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('setting.index', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $setting->nama_toko = $request->nama_toko;
        $setting->alamat = $request->alamat;
        $setting->telepon = $request->telepon;

        if ($request->has('path_logo')) {
            $file = $request->file('path_logo');
            $nama = 'kartu-member-' . date('Y-m-dHis') . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $setting->path_kartu_member = "/img/$nama";
        }
        if ($request->has('path_kartu_member')) {
            $file = $request->file('path_kartu_member');
            $nama = 'kartu-member-' . date('Y-m-dHis') . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $setting->path_kartu_member = "/img/$nama";
        }

        $setting->tipe_nota = $request->tipe_nota;
        $setting->diskon = $request->diskon;
        $setting->update();

        return redirect()->back()->with('success', 'Data Toko Berhasil Diupdate');
    }
}
