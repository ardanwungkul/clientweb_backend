<?php
namespace App\Http\Controllers;

use App\Models\NameServer;
use Illuminate\Http\Request;

class NameServerController extends Controller
{
        public function index()
        {
            $nameServers = NameServer::all();
            return response()->json([
                'data' => $nameServers
            ]);
        }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'nameserver1' => 'required|string',
            'nameserver2' => 'required|string',
            'tanggal_ns' => 'required|date',
            'status_ns' => 'required|string',
        ]);

        $ns = NameServer::create($validated);

        return response()->json($ns, 201);
    }

    public function show($id)
    {
        $ns = NameServer::find($id);
        if (!$ns) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($ns);
    }

    public function update(Request $request, $id)
    {
        $ns = NameServer::find($id);
        if (!$ns) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nameserver1' => 'required|string',
            'nameserver2' => 'required|string',
            'tanggal_ns' => 'required|date',
            'status_ns' => 'required|string',
        ]);

        $ns->update($validated);

        return response()->json($ns);
    }

    public function destroy($id)
    {
        $ns = NameServer::find($id);
        if (!$ns) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $ns->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
