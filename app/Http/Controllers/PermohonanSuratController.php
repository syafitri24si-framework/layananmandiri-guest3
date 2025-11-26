<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use Illuminate\Http\Request;

class PermohonanSuratController extends Controller
{
    public function index(Request $request)
{
    $query = PermohonanSurat::with(['warga', 'jenisSurat']);

    // Apply existing filters
    $filterableColumns = ['status', 'jenis_id', 'warga_id'];
    foreach ($filterableColumns as $column) {
        if ($request->filled($column)) {
            $query->where($column, $request->input($column));
        }
    }

    // Apply search
    if ($request->filled('search')) {
        $searchTerm = $request->input('search');
        $query->where(function($q) use ($searchTerm) {
            $q->where('nomor_permohonan', 'like', '%' . $searchTerm . '%')
              ->orWhereHas('warga', function($wargaQuery) use ($searchTerm) {
                  $wargaQuery->where('nama', 'like', '%' . $searchTerm . '%');
              })
              ->orWhereHas('jenisSurat', function($jenisQuery) use ($searchTerm) {
                  $jenisQuery->where('nama_jenis', 'like', '%' . $searchTerm . '%');
              });
        });
    }

    $data = $query->paginate(12)->withQueryString();

    // Data untuk dropdown filter
    $warga = Warga::orderBy('nama', 'asc')->get();
    $jenisSurat = JenisSurat::all();

    return view('pages.permohonan_surat.index', compact('data', 'warga', 'jenisSurat'));
}

    // CREATE – tampilkan form tambah
    public function create()
    {
        $warga = Warga::orderBy('nama', 'asc')->get();
        $jenisSurat = JenisSurat::all();

        return view('pages.permohonan_surat.create', compact('warga', 'jenisSurat'));
    }

    // STORE – simpan data permohonan
    public function store(Request $request)
    {
        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        PermohonanSurat::create([
            'nomor_permohonan' => $request->nomor_permohonan,
            'warga_id' => $request->warga_id,
            'jenis_id' => $request->jenis_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil ditambahkan.');
    }

    // EDIT – form edit
    public function edit($id)
    {
        $data = PermohonanSurat::findOrFail($id);
        $warga = Warga::orderBy('nama', 'asc')->get();
        $jenisSurat = JenisSurat::all();

        return view('pages.permohonan_surat.edit', compact('data', 'warga', 'jenisSurat'));
    }

    // UPDATE – update data
    public function update(Request $request, $id)
    {
        $data = PermohonanSurat::findOrFail($id);

        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required',
        ]);

        $data->update([
            'nomor_permohonan' => $request->nomor_permohonan,
            'warga_id' => $request->warga_id,
            'jenis_id' => $request->jenis_id,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil diperbarui.');
    }

    // DELETE – hapus data
    public function destroy($id)
    {
        PermohonanSurat::findOrFail($id)->delete();

        return redirect()->route('permohonan_surat.index')->with('success', 'Data berhasil dihapus.');
    }
}
