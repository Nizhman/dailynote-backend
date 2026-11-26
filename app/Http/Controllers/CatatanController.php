<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    // 1. Mengambil seluruh catatan
    public function index()
    {
        $catatan = Catatan::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data catatan berhasil diambil',
            'data' => $catatan
        ], 200);
    }

    // 2. Mengambil detail catatan berdasarkan ID
    public function show($id)
    {
        $catatan = Catatan::find($id);

        if (!$catatan) {
            return response()->json([
                'success' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail catatan berhasil diambil',
            'data' => $catatan
        ], 200);
    }

    // 3. Menambahkan catatan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:100'
        ]);

        $catatan = Catatan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil ditambahkan',
            'data' => $catatan
        ], 201);
    }

    // 4. Memperbarui catatan
    public function update(Request $request, $id)
    {
        $catatan = Catatan::find($id);

        if (!$catatan) {
            return response()->json([
                'success' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:100'
        ]);

        $catatan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Catatan berhasil diperbarui',
            'data' => $catatan
        ], 200);
    }

    // 5. Menghapus catatan
    public function destroy($id)
    {
        $catatan = Catatan::find($id);

        if (!$catatan) {
            return response()->json([
                'success' => false,
                'message' => 'Catatan tidak ditemukan'
            ], 404);
        }

        $catatan->delete();

        return response()->json(null, 204);
    }
}
