<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Tampilkan semua data warga.
     */
    public function index(Request $request)
    {
        $query = Warga::query();

        // Apply existing filters
        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->input('jenis_kelamin'));
        }

        if ($request->filled('agama')) {
            $query->where('agama', $request->input('agama'));
        }

        // Apply search
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama', 'like', '%' . $searchTerm . '%')
                  ->orWhere('no_ktp', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('telp', 'like', '%' . $searchTerm . '%')
                  ->orWhere('pekerjaan', 'like', '%' . $searchTerm . '%');
            });
        }

        $warga = $query->paginate(12);

        return view('pages.warga.index', compact('warga'));
    }

    /**
     * Form tambah data warga.
     */
    public function create()
    {
        return view('pages.warga.create');
    }

    /**
     * Simpan data warga baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp' => 'required|unique:warga,no_ktp|max:16',
            'nama' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:50',
            'pekerjaan' => 'nullable|string|max:100',
            'telp' => 'nullable|string|max:15',
            'email' => 'nullable|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail warga.
     */
    public function show($id)
    {
        $data['warga'] = Warga::findOrFail($id);
        return view('pages.warga.show', $data);
    }

    /**
     * Form edit data warga.
     */
    public function edit($id)
    {
        $data['warga'] = Warga::findOrFail($id);
        return view('pages.warga.edit', $data);
    }

    /**
     * Update data warga.
     */
    public function update(Request $request, $id)
    {
        $warga_id = $id;
        $warga = Warga::findOrFail($warga_id);

        $warga->no_ktp = $request->no_ktp;
        $warga->nama = $request->nama;
        $warga->jenis_kelamin = $request->jenis_kelamin;
        $warga->agama = $request->agama;
        $warga->pekerjaan = $request->pekerjaan;
        $warga->telp = $request->telp;
        $warga->email = $request->email;

        $warga->save();

        return redirect()->route('warga.index')->with('success', 'Perubahan Data Warga Berhasil!');
    }

    /**
     * Hapus data warga.
     */
    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
