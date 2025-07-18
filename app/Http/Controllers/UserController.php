<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('whereNot')) {
            $whereNot = $request->query('whereNot');
            foreach ($whereNot as $item) {
                foreach ($item as $key => $value) {
                    $query->where($key, '!=', $value);
                }
            }
        }

        $data = $query->get();

        return response()->json([
            'message' => 'Berhasil Mendapatkan Data',
            'data' => $data
        ]);
    }

    public function create() {}

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'message' => 'Berhasil Menambahkan User',
            'data' => $user
        ]);
    }

    public function show(string $id) {}

    public function edit(string $id) {}

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

       
        if ($request->has('password') && $request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Berhasil Mengupdate User',
            'data' => $user
        ]);
    }

    public function destroy(User $user)
    {
        if ($user->role !== 'admin') {
            $user->delete();
            return response()->json([
                'message' => 'Berhasil Menghapus User',
                'data' => $user
            ]);
        }

        return response()->json([
            'message' => 'Tidak dapat menghapus user admin'
        ], 403);
    }
}
