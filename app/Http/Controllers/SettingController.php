<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            $path = time() . '_' . 'logo_toko' . '.' . $file->getClientOriginalExtension();

            Storage::disk('setting')->put($path, file_get_contents($file));

            // Optionally, delete the old image file
            if ($setting->path_logo) {
                Storage::disk('setting')->delete($setting->path_logo);
            }

            $setting->path_logo = $path;
        }
        if ($request->has('path_kartu_member')) {
            $file = $request->file('path_kartu_member');
            $path = time() . '_' . 'kartu_member' . '.' . $file->getClientOriginalExtension();

            Storage::disk('setting')->put($path, file_get_contents($file));

            // Optionally, delete the old image file
            if ($setting->path_kartu_member) {
                Storage::disk('setting')->delete($setting->path_kartu_member);
            }

            $setting->path_kartu_member = $path;
        }

        $setting->tipe_nota = $request->tipe_nota;
        $setting->diskon = $request->diskon;
        $setting->update();

        return redirect()->back()->with('success', 'Data Toko Berhasil Diupdate');
    }
}
