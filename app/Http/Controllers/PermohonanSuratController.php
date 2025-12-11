<?php

namespace App\Http\Controllers;

use App\Models\PermohonanSurat;
use App\Models\Warga;
use App\Models\JenisSurat;
use App\Models\Media;
use App\Models\BerkasPersyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PermohonanSuratController extends Controller
{
    public function index(Request $request)
    {
        $query = PermohonanSurat::with(['warga', 'jenisSurat', 'mediaFiles']);

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

        $data = $query->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

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

        // Generate nomor permohonan
        $nomorPermohonan = PermohonanSurat::generateNomorPermohonan();

        return view('pages.permohonan_surat.create', compact('warga', 'jenisSurat', 'nomorPermohonan'));
    }

    // STORE – simpan data permohonan dengan multiple upload
    public function store(Request $request)
    {
        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:500',
            'berkas_files' => 'required|array|min:1',
            'berkas_files.*' => 'file|max:5120', // 5MB per file
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:100'
        ]);

        // Validasi ekstensi file
        if ($request->hasFile('berkas_files')) {
            foreach ($request->file('berkas_files') as $file) {
                $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
                $extension = $file->getClientOriginalExtension();

                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['berkas_files' => 'Format file tidak didukung. Hanya PDF, JPG, PNG, DOC, DOCX yang diperbolehkan.']);
                }
            }
        }

        DB::beginTransaction();
        try {
            // Simpan data permohonan
            $permohonan = PermohonanSurat::create([
                'nomor_permohonan' => $request->nomor_permohonan,
                'warga_id' => $request->warga_id,
                'jenis_id' => $request->jenis_id,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'status' => $request->status,
                'catatan' => $request->catatan,
            ]);

            // Buat riwayat status awal
            $permohonan->tambahRiwayatStatus($request->status, null, 'Permohonan diajukan');

            // Handle multiple file upload
            if ($request->hasFile('berkas_files')) {
                $folder = 'permohonan_surat';
                $storagePath = "uploads/{$folder}/";

                foreach ($request->file('berkas_files') as $index => $file) {
                    // Generate unique filename
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $extension;

                    // Simpan file ke storage
                    $file->storeAs("public/{$storagePath}", $filename);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'permohonan_surat',
                        'ref_id' => $permohonan->permohonan_id,
                        'file_name' => $filename,
                        'caption' => $request->captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);
                }
            }

            // Tambahkan berkas persyaratan berdasarkan jenis surat (jika ada)
            $jenisSurat = JenisSurat::find($request->jenis_id);
            if ($jenisSurat && $jenisSurat->syarat_json) {
                $syaratArray = is_string($jenisSurat->syarat_json)
                    ? json_decode($jenisSurat->syarat_json, true)
                    : $jenisSurat->syarat_json;

                if (is_array($syaratArray) && count($syaratArray) > 0) {
                    foreach ($syaratArray as $syarat) {
                        BerkasPersyaratan::create([
                            'permohonan_id' => $permohonan->permohonan_id,
                            'nama_berkas' => $syarat,
                            'valid' => 'menunggu'
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('permohonan_surat.index')
                ->with('success', 'Permohonan surat berhasil diajukan dengan ' . count($request->file('berkas_files')) . ' berkas pendukung.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // SHOW – tampilkan detail permohonan
    public function show($id)
    {
        $data = PermohonanSurat::with([
            'warga',
            'jenisSurat',
            'mediaFiles',
            'berkasPersyaratan',
            'riwayatStatus' => function($query) {
                $query->orderBy('waktu', 'desc');
            },
            'riwayatStatus.petugas'
        ])->findOrFail($id);

        return view('pages.permohonan_surat.show', compact('data'));
    }

    // EDIT – form edit
    public function edit($id)
    {
        $data = PermohonanSurat::with(['mediaFiles'])->findOrFail($id);
        $warga = Warga::orderBy('nama', 'asc')->get();
        $jenisSurat = JenisSurat::all();

        return view('pages.permohonan_surat.edit', compact('data', 'warga', 'jenisSurat'));
    }

    // UPDATE – update data dengan multiple upload
    public function update(Request $request, $id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        $request->validate([
            'nomor_permohonan' => 'required|unique:permohonan_surat,nomor_permohonan,' . $id . ',permohonan_id',
            'warga_id' => 'required|exists:warga,warga_id',
            'jenis_id' => 'required|exists:jenis_surat,jenis_id',
            'tanggal_pengajuan' => 'required|date',
            'status' => 'required|in:diajukan,diproses,selesai,ditolak',
            'catatan' => 'nullable|string|max:500',
            'berkas_files' => 'nullable|array',
            'berkas_files.*' => 'file|max:5120', // 5MB per file
            'captions' => 'nullable|array',
            'captions.*' => 'nullable|string|max:100',
            'delete_files' => 'nullable|array',
            'delete_files.*' => 'exists:media,media_id',
            'new_captions' => 'nullable|array',
            'new_captions.*' => 'nullable|string|max:100'
        ]);

        // Validasi ekstensi file baru
        if ($request->hasFile('berkas_files')) {
            foreach ($request->file('berkas_files') as $file) {
                $allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx'];
                $extension = $file->getClientOriginalExtension();

                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors(['berkas_files' => 'Format file tidak didukung. Hanya PDF, JPG, PNG, DOC, DOCX yang diperbolehkan.']);
                }
            }
        }

        DB::beginTransaction();
        try {
            // Cek apakah status berubah untuk membuat riwayat
            if ($permohonan->status !== $request->status) {
                $permohonan->updateStatus($request->status, null, 'Status diperbarui');
            }

            // Update data permohonan
            $permohonan->update([
                'nomor_permohonan' => $request->nomor_permohonan,
                'warga_id' => $request->warga_id,
                'jenis_id' => $request->jenis_id,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'status' => $request->status,
                'catatan' => $request->catatan,
            ]);

            // Update caption untuk berkas yang sudah ada
            if ($request->has('captions')) {
                foreach ($request->captions as $mediaId => $caption) {
                    Media::where('media_id', $mediaId)
                        ->where('ref_table', 'permohonan_surat')
                        ->where('ref_id', $permohonan->permohonan_id)
                        ->update(['caption' => $caption]);
                }
            }

            // Hapus file yang dipilih
            if ($request->has('delete_files')) {
                foreach ($request->delete_files as $mediaId) {
                    $media = Media::find($mediaId);
                    if ($media && $media->ref_table === 'permohonan_surat' && $media->ref_id == $permohonan->permohonan_id) {
                        // Hapus file dari storage
                        $folder = 'permohonan_surat';
                        $storagePath = "uploads/{$folder}/{$media->file_name}";
                        Storage::delete('public/' . $storagePath);

                        // Hapus record dari database
                        $media->delete();
                    }
                }
            }

            // Handle upload file baru
            if ($request->hasFile('berkas_files')) {
                $folder = 'permohonan_surat';
                $storagePath = "uploads/{$folder}/";

                // Get current max sort_order
                $maxSortOrder = Media::where('ref_table', 'permohonan_surat')
                    ->where('ref_id', $permohonan->permohonan_id)
                    ->max('sort_order') ?? -1;

                foreach ($request->file('berkas_files') as $index => $file) {
                    // Generate unique filename
                    $originalName = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '_' . uniqid() . '.' . $extension;

                    // Simpan file ke storage
                    $file->storeAs("public/{$storagePath}", $filename);

                    // Simpan ke tabel media
                    Media::create([
                        'ref_table' => 'permohonan_surat',
                        'ref_id' => $permohonan->permohonan_id,
                        'file_name' => $filename,
                        'caption' => $request->new_captions[$index] ?? null,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => ++$maxSortOrder,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('permohonan_surat.index')
                ->with('success', 'Permohonan surat berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    // DELETE – hapus data
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $permohonan = PermohonanSurat::findOrFail($id);

            // Hapus semua file terkait
            $mediaFiles = Media::where('ref_table', 'permohonan_surat')
                ->where('ref_id', $permohonan->permohonan_id)
                ->get();

            foreach ($mediaFiles as $media) {
                // Hapus file dari storage
                $folder = 'permohonan_surat';
                $storagePath = "uploads/{$folder}/{$media->file_name}";
                Storage::delete('public/' . $storagePath);

                // Hapus record media
                $media->delete();
            }

            // Hapus permohonan (akan cascade ke berkas_persyaratan dan riwayat_status_surat)
            $permohonan->delete();

            DB::commit();

            return redirect()->route('permohonan_surat.index')
                ->with('success', 'Permohonan surat dan semua berkas terkait berhasil dihapus.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()
                ->withErrors(['error' => 'Terjadi kesalahan saat menghapus: ' . $e->getMessage()]);
        }
    }
}
