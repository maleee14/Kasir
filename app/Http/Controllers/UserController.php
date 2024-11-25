<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            $user->password =  bcrypt($request->password);
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
}
