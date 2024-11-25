<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $user = User::isNotAdmin()->orderBy('id')->get();
        return view('user.index', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',

        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 2,
            'foto' => null,
        ]);

        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambahkan');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',

        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password') && $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->update();

        return redirect()->route('user.index')->with('success', 'User Berhasil Diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User Berhasil Dihapus');
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed',

        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->has('password') && $request->password != "") {
            $user->password = Hash::make($request->password);
        }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

            Storage::disk('profile')->put($path, file_get_contents($file));

            // Optionally, delete the old image file
            if ($user->foto) {
                Storage::disk('profile')->delete($user->foto);
            }

            $user->foto = $path;
        }

        $user->update();
        return redirect()->route('user.profile')->with('success', 'Berhasil Update Profile');
    }
}
