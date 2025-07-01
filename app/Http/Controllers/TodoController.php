<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Todo::query();
        $data = $query->get();
        return response()->json([
            'message' => 'Berhasil Mendapatkan Data',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $todo = new Todo();
        $todo->subject = $request->subject;
        $todo->catatan = $request->catatan;
        $todo->user_id = $request->user_id ? $request->user_id : Auth::user()->id;
        $todo->todo_from = Auth::user()->id;
        $todo->save();

        return response()->json(['data' => $todo->fresh(), 'message' => 'Berhasil Menambahkan Task']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        if ($request->status) {
            $todo->status = $request->status;
            $todo->save();
            return response()->json(['message' => 'Berhasil Mengubah Status', 'data' => $todo]);
        } else if ($request->catatan) {
            $todo->catatan = $request->catatan;
            $todo->save();
            return response()->json(['message' => 'Berhasil Mengubah Catatan', 'data' => $todo]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(['data' => $todo, 'message' => 'Berhasil Menghapus Task']);
    }
}
