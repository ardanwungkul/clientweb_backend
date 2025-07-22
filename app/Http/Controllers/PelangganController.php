<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->latest()->get();

        return response()->json([
            'message' => 'Data pelanggan berhasil diambil',
            'data' => $pelanggans,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = new User();
        $user->name = $validated['nama_pelanggan'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->role = 'user';
        $user->save();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pelanggan', 'public');
        }

        $pelanggan = new Pelanggan();
        $pelanggan->user_id = $user->id;
        $pelanggan->nama_pelanggan = $validated['nama_pelanggan'];
        $pelanggan->alamat = $validated['alamat'];
        $pelanggan->no_hp = $validated['no_hp'] ?? null;
        $pelanggan->image = $imagePath;
        $pelanggan->save();

        return response()->json([
            'message' => 'Pelanggan berhasil ditambahkan',
            'data' => $pelanggan,
        ]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pelanggan', 'public');
        }

        $pelanggan->nama_pelanggan = $validated['nama_pelanggan'];
        $pelanggan->alamat = $validated['alamat'];
        $pelanggan->no_hp = $validated['no_hp'] ?? null;
        if (isset($validated['image'])) {
            $pelanggan->image = $validated['image'];
        }
        $pelanggan->save();

        return response()->json([
            'message' => 'Pelanggan berhasil diperbarui',
            'data' => $pelanggan,
        ]);
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json([
            'message' => 'Pelanggan berhasil dihapus',
        ]);
    }
}
