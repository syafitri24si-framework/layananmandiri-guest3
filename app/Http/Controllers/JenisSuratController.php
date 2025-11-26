<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    /**
     * Tampilkan semua jenis surat.
     */
  public function index(Request $request)
{
    $query = JenisSurat::query();

    // Apply existing filter
    if ($request->filled('kode')) {
        $query->where('kode', $request->input('kode'));
    }

    // Apply search
    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('nama_jenis', 'like', '%' . $searchTerm . '%')
              ->orWhere('kode', 'like', '%' . $searchTerm . '%');
        });
    }

    $jenisSurat = $query->paginate(5)->withQueryString();

    // Ambil semua kode surat yang ada di database untuk dropdown
    $kodeSurat = JenisSurat::select('kode')->distinct()->orderBy('kode')->get();

    return view('pages.jenis_surat.index', compact('jenisSurat', 'kodeSurat'));
}

    /**
     * Form tambah jenis surat.
     */
    public function create()
    {
        return view('pages.jenis_surat.create');
    }

    /**
     * Simpan data jenis surat baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|unique:jenis_surat,kode|max:20',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|array',
        ]);

        JenisSurat::create([
            'kode' => $validated['kode'],
            'nama_jenis' => $validated['nama_jenis'],
            'syarat_json' => $validated['syarat_json'] ?? [],
        ]);

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil ditambahkan!');
    }

    /**
     * Form edit jenis surat.
     */
    public function edit($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('pages.jenis_surat.edit', compact('jenisSurat'));
    }

    /**
     * Update jenis surat.
     */
    public function update(Request $request, $id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|max:20|unique:jenis_surat,kode,' . $jenisSurat->jenis_id . ',jenis_id',
            'nama_jenis' => 'required|string|max:100',
            'syarat_json' => 'nullable|string',
        ]);

        $jenisSurat->update([
            'kode' => $validated['kode'],
            'nama_jenis' => $validated['nama_jenis'],
            'syarat_json' => $validated['syarat_json'] ? array_map('trim', explode(',', $validated['syarat_json'])) : [],
        ]);

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil diperbarui!');
    }

    /**
     * Hapus jenis surat.
     */
    public function destroy($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil dihapus!');
    }
}
