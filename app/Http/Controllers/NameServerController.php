<?php

namespace App\Http\Controllers;

use App\Models\NameServer;
use Illuminate\Http\Request;

class NameServerController extends Controller
{
    public function index()
    {
        $name_server = NameServer::all();
        return response()->json([
            'data' => $name_server
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'nameserver1' => 'required|string',
            'nameserver2' => 'required|string',
            'tanggal_ns' => 'required|date',
        ]);

        $name_server = new NameServer();
        $name_server->nameserver1 = $request->nameserver1;
        $name_server->nameserver2 = $request->nameserver2;
        $name_server->tanggal_ns = $request->tanggal_ns;
        $name_server->save();

        return response()->json(['data' => $name_server, 'message' => 'Berhasil Menambahkan Nameserver']);
    }

    public function update(Request $request, Nameserver $name_server)
    {

        if ($request->has('nameserver1')) {
            $name_server->nameserver1 = $request->nameserver1;
        }

        if ($request->has('nameserver2')) {
            $name_server->nameserver2 = $request->nameserver2;
        }

        if ($request->has('tanggal_ns')) {
            $name_server->tanggal_ns = $request->tanggal_ns;
        }
        if ($request->has('status_ns')) {
            $name_server->status_ns = $request->status_ns;
        }
        $name_server->save();

        return response()->json(['message' => 'Berhasil Mengubah Nameserver', 'data' => $name_server]);
    }

    public function destroy(NameServer $name_server)
    {
        $name_server->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
