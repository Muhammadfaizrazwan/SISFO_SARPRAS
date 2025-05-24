<?php

namespace App\Http\Controllers;

use App\Models\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = pengguna::all();
        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
        ]);

        pengguna::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengguna = pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = pengguna::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:pengguna,email,' . $id,
            'password' => 'nullable|min:6',
        ]);

        $pengguna->email = $request->email;
        if ($request->filled('password')) {
            $pengguna->password = Hash::make($request->password);
        }
        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diupdate.');
    }

    public function destroy($id)
    {
        $pengguna = pengguna::findOrFail($id);
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
