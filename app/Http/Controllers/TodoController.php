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
    public function index(Request $request)
    {
        $query = Todo::query();

        if ($request->type == 'by-user-auth') {
            $query->where('user_id', Auth::user()->id);
        } else if ($request->type == 'by-user-id') {
            $query->where('user_id', $request->user_id);
        }
        if ($request->has('whereNot')) {
            $whereNot = $request->query('whereNot');

            foreach ($whereNot as  $item) {
                foreach ($item as $key => $value) {
                    $query->where($key, '!=', $value);
                }
            }
        }

        if ($request->has('orderBy')) {
            $orderBy = $request->query('orderBy');
            foreach ($orderBy as $item) {
                foreach ($item as $key => $value) {
                    $query->orderBy($key, $value);
                }
            }
        }

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

        $request->validate([
            'subject' => 'required',
            'catatan' => 'required'
        ]);
        $todo = new Todo();
        $todo->subject = $request->subject;
        $todo->catatan = $request->catatan;
        $todo->user_id = $request->user_id ? $request->user_id : Auth::user()->id;
        $todo->todo_from = Auth::user()->id;
        $todo->save();

        return response()->json(['data' => $todo->fresh(), 'message' => 'Berhasil Menambahkan Task']);
    }
    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item) {
            Todo::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
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
        } else if ($request->subject) {
            $todo->subject = $request->subject;
            $todo->save();
            return response()->json(['message' => 'Berhasil Mengubah Subject', 'data' => $todo]);
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
    public function submit(Request $request)
    {
        $todo = [];
        foreach ($request->todo as $id) {
            $td = Todo::find($id);
            $td->status = 'deleted';
            $td->done_at = now();
            $td->save();
            $todo[] = $td;
        }
        return response()->json(['message' => 'Berhasil Melakukan Submit Task', 'data' => $todo]);
    }
}
