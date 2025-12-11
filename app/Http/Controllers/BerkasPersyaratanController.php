<?php
// app/Http/Controllers/BerkasPersyaratanController.php

namespace App\Http\Controllers;

use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class BerkasPersyaratanController extends Controller
{
    public function index(Request $request)
    {
        $query = BerkasPersyaratan::with(['permohonan.warga', 'permohonan.jenisSurat']);

        // Filter
        if ($request->filled('permohonan_id')) {
            $query->where('permohonan_id', $request->permohonan_id);
        }

        if ($request->filled('valid')) {
            $query->where('valid', $request->valid);
        }

        if ($request->filled('nama_berkas')) {
            $query->where('nama_berkas', $request->nama_berkas);
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_berkas', 'like', '%' . $request->search . '%');
            });
        }

        $berkasData = $query->orderBy('created_at', 'desc')->paginate(12);
        $permohonanList = PermohonanSurat::with('warga')->get();
        $selectedPermohonanId = $request->input('permohonan_id');

        return view('pages.berkas_persyaratan.index', compact(
            'berkasData',
            'permohonanList',
            'selectedPermohonanId'
        ));
    }

    public function create(Request $request)
    {
        $permohonanList = PermohonanSurat::with('warga', 'jenisSurat')->get();
        $selectedPermohonanId = $request->input('permohonan_id');

        return view('pages.berkas_persyaratan.create', compact('permohonanList', 'selectedPermohonanId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permohonan_id' => 'required|exists:permohonan_surat,permohonan_id',
            'nama_berkas' => 'required|string|max:255',
            'valid' => 'required|in:menunggu,valid,tidak_valid',
            'files' => 'required|array|min:1',
            'files.*' => 'file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
            'captions.*' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // 1. Simpan data berkas persyaratan
            $berkas = BerkasPersyaratan::create([
                'permohonan_id' => $request->permohonan_id,
                'nama_berkas' => $request->nama_berkas, // LANGSUNG PAKAI $request->nama_berkas
                'valid' => $request->valid,
            ]);

            // 2. Upload multiple files ke tabel media
            $uploadedCount = 0;
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $index => $file) {
                    // Pastikan file valid
                    if (!$file->isValid()) {
                        continue;
                    }

                    // Generate unique filename
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;

                    // Simpan file
                    $filePath = $file->storeAs('uploads/berkas_persyaratan', $fileName, 'public');

                    // Get caption for this file
                    $caption = $request->captions[$index] ?? $request->nama_berkas; // PAKAI $request->nama_berkas

                    Media::create([
                        'ref_table' => 'berkas_persyaratan',
                        'ref_id' => $berkas->berkas_id,
                        'file_name' => $fileName,
                        'caption' => $caption,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $index,
                    ]);

                    $uploadedCount++;
                }
            }

            // Cek apakah ada file yang berhasil diupload
            if ($uploadedCount === 0) {
                throw new \Exception('Tidak ada file yang valid untuk diupload');
            }

            DB::commit();

            // Redirect DENGAN PARAMETER permohonan_id
            return redirect()->route('berkas_persyaratan.index', [
                'permohonan_id' => $request->permohonan_id
            ])->with('success', 'Berkas persyaratan berhasil ditambahkan dengan ' . $uploadedCount . ' file!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log error untuk debugging
            \Log::error('Error uploading berkas: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->except(['files'])
            ]);

            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);
        $permohonanList = PermohonanSurat::with('warga', 'jenisSurat')->get();

        // Ambil semua file media terkait
        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.berkas_persyaratan.edit', compact('berkas', 'permohonanList', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_berkas' => 'required|string|max:255',
            'valid' => 'required|in:menunggu,valid,tidak_valid',
            'files.*' => 'nullable|file|max:10240|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx',
            'captions.*' => 'nullable|string|max:255',
            'existing_captions.*' => 'nullable|string|max:255',
            'delete_media.*' => 'nullable|boolean',
        ]);

        DB::beginTransaction();
        try {
            $berkas = BerkasPersyaratan::findOrFail($id);

            // 1. Update data berkas (LANGSUNG PAKAI $request->nama_berkas)
            $berkas->update([
                'nama_berkas' => $request->nama_berkas,
                'valid' => $request->valid,
            ]);

            // 2. Hapus file yang dipilih
            if ($request->has('delete_media')) {
                foreach ($request->delete_media as $mediaId => $value) {
                    if ($value == '1') {
                        $media = Media::find($mediaId);
                        if ($media && $media->ref_table == 'berkas_persyaratan' && $media->ref_id == $id) {
                            // Hapus file dari storage
                            Storage::disk('public')->delete('uploads/berkas_persyaratan/' . $media->file_name);
                            $media->delete();
                        }
                    }
                }
            }

            // 3. Update captions untuk file yang sudah ada
            if ($request->has('existing_captions')) {
                foreach ($request->existing_captions as $mediaId => $caption) {
                    $media = Media::find($mediaId);
                    if ($media && $media->ref_table == 'berkas_persyaratan' && $media->ref_id == $id) {
                        $media->update(['caption' => $caption]);
                    }
                }
            }

            // 4. Tambah file baru jika ada
            $newFileCount = 0;
            if ($request->hasFile('files')) {
                $existingMediaCount = Media::where('ref_table', 'berkas_persyaratan')
                    ->where('ref_id', $id)
                    ->count();

                foreach ($request->file('files') as $index => $file) {
                    // Pastikan file valid
                    if (!$file->isValid()) {
                        continue;
                    }

                    // Generate unique filename
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $fileName = $originalName . '_' . time() . '_' . uniqid() . '.' . $extension;

                    $filePath = $file->storeAs('uploads/berkas_persyaratan', $fileName, 'public');

                    // Get caption for this file
                    $caption = $request->captions[$index] ?? $request->nama_berkas; // PAKAI $request->nama_berkas

                    Media::create([
                        'ref_table' => 'berkas_persyaratan',
                        'ref_id' => $id,
                        'file_name' => $fileName,
                        'caption' => $caption,
                        'mime_type' => $file->getMimeType(),
                        'sort_order' => $existingMediaCount + $index,
                    ]);

                    $newFileCount++;
                }
            }

            DB::commit();

            // Redirect dengan parameter permohonan_id jika ada
            $redirectParams = [];
            if ($berkas->permohonan_id) {
                $redirectParams['permohonan_id'] = $berkas->permohonan_id;
            }

            $successMessage = 'Berkas persyaratan berhasil diperbarui!';
            if ($newFileCount > 0) {
                $successMessage .= ' Ditambahkan ' . $newFileCount . ' file baru.';
            }

            return redirect()->route('berkas_persyaratan.index', $redirectParams)
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error updating berkas: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $berkas = BerkasPersyaratan::findOrFail($id);
            $permohonanId = $berkas->permohonan_id; // Simpan dulu untuk redirect

            // Hapus semua file media terkait
            $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')
                ->where('ref_id', $id)
                ->get();

            foreach ($mediaFiles as $media) {
                Storage::disk('public')->delete('uploads/berkas_persyaratan/' . $media->file_name);
                $media->delete();
            }

            // Hapus berkas
            $berkas->delete();

            DB::commit();

            // Redirect dengan parameter permohonan_id jika ada
            $redirectParams = [];
            if ($permohonanId) {
                $redirectParams['permohonan_id'] = $permohonanId;
            }

            return redirect()->route('berkas_persyaratan.index', $redirectParams)
                ->with('success', 'Berkas persyaratan berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();

            \Log::error('Error deleting berkas: ' . $e->getMessage());

            return redirect()->route('berkas_persyaratan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $berkas = BerkasPersyaratan::with(['permohonan.warga', 'permohonan.jenisSurat'])->findOrFail($id);

        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.berkas_persyaratan.show', compact('berkas', 'mediaFiles'));
    }

    public function downloadFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);

        // Verifikasi bahwa media ini milik berkas_persyaratan
        if ($media->ref_table !== 'berkas_persyaratan') {
            return redirect()->back()->with('error', 'File tidak valid.');
        }

        $filePath = storage_path('app/public/uploads/berkas_persyaratan/' . $media->file_name);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // PERBAIKAN: Gunakan nama file asli jika caption kosong
        $downloadName = $media->caption
            ? $media->caption . '.' . pathinfo($media->file_name, PATHINFO_EXTENSION)
            : $media->file_name;

        return response()->download($filePath, $downloadName);
    }
}
