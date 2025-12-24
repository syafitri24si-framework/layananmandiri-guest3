<?php
// app/Http/Controllers/BerkasPersyaratanController.php

namespace App\Http\Controllers;

use App\Models\BerkasPersyaratan;
use App\Models\PermohonanSurat;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BerkasPersyaratanController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // Inisialisasi query
        $query = BerkasPersyaratan::with(['permohonan.warga', 'permohonan.jenisSurat']);

        // Filter berdasarkan role
        if ($user->isWarga()) {
            // Warga hanya bisa lihat berkas miliknya
            $wargaData = $user->dataWarga();

            if ($wargaData) {
                $permohonanIds = $wargaData->permohonanSurat->pluck('permohonan_id');
                $query->whereIn('permohonan_id', $permohonanIds);
            } else {
                // Jika tidak ada data warga, kembalikan hanya data kosong
            $berkasData = BerkasPersyaratan::where('permohonan_id', 0)->paginate(12);
                $permohonanList = collect();
                $selectedPermohonanId = $request->input('permohonan_id');

                return view('pages.berkas_persyaratan.index', compact(
                    'berkasData',
                    'permohonanList',
                    'selectedPermohonanId'
                ));
            }
        }

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

        // Permohonan list (hanya untuk admin atau permohonan milik warga)
        if ($user->isAdmin()) {
            $permohonanList = PermohonanSurat::with('warga')->get();
        } else {
            $wargaData = $user->dataWarga();
            $permohonanList = $wargaData ? $wargaData->permohonanSurat : collect();
        }

        $selectedPermohonanId = $request->input('permohonan_id');

        return view('pages.berkas_persyaratan.index', compact(
            'berkasData',
            'permohonanList',
            'selectedPermohonanId'
        ));
    }

    public function create(Request $request)
    {
        $user = Auth::user();

        // Permohonan list (hanya untuk admin atau permohonan milik warga)
        if ($user->isAdmin()) {
            $permohonanList = PermohonanSurat::with('warga', 'jenisSurat')->get();
        } else {
            $wargaData = $user->dataWarga();
            $permohonanList = $wargaData ? $wargaData->permohonanSurat : collect();
        }

        $selectedPermohonanId = $request->input('permohonan_id');

        return view('pages.berkas_persyaratan.create', compact('permohonanList', 'selectedPermohonanId'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Authorization check untuk warga
        if ($user->isWarga()) {
            $wargaData = $user->dataWarga();
            $permohonan = PermohonanSurat::find($request->permohonan_id);

            if (!$permohonan || $permohonan->warga_id != $wargaData->warga_id) {
                return abort(403, 'Anda hanya bisa menambahkan berkas untuk permohonan Anda sendiri.');
            }
        }

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
                'nama_berkas' => $request->nama_berkas,
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
                    $caption = $request->captions[$index] ?? $request->nama_berkas;

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

            $message = 'Berkas persyaratan berhasil ditambahkan dengan ' . $uploadedCount . ' file!';
            if ($user->isWarga()) {
                $message = 'Berkas persyaratan Anda berhasil ditambahkan!';
            }

            // Redirect DENGAN PARAMETER permohonan_id
            return redirect()->route('berkas_persyaratan.index', [
                'permohonan_id' => $request->permohonan_id
            ])->with('success', $message);

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
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessBerkas($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengedit data ini.');
        }

        // Permohonan list (hanya untuk admin atau permohonan milik warga)
        if ($user->isAdmin()) {
            $permohonanList = PermohonanSurat::with('warga', 'jenisSurat')->get();
        } else {
            $wargaData = $user->dataWarga();
            $permohonanList = $wargaData ? collect([$berkas->permohonan]) : collect();
        }

        // Ambil semua file media terkait
        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.berkas_persyaratan.edit', compact('berkas', 'permohonanList', 'mediaFiles'));
    }

    public function update(Request $request, $id)
    {
        $berkas = BerkasPersyaratan::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessBerkas($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengupdate data ini.');
        }

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
            // 1. Update data berkas
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
                    $caption = $request->captions[$index] ?? $request->nama_berkas;

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

            $successMessage = 'Berkas persyaratan berhasil diperbarui!';
            if ($newFileCount > 0) {
                $successMessage .= ' Ditambahkan ' . $newFileCount . ' file baru.';
            }

            if ($user->isWarga()) {
                $successMessage = 'Berkas persyaratan Anda berhasil diperbarui!';
            }

            // Redirect dengan parameter permohonan_id jika ada
            $redirectParams = [];
            if ($berkas->permohonan_id) {
                $redirectParams['permohonan_id'] = $berkas->permohonan_id;
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
        $berkas = BerkasPersyaratan::findOrFail($id);
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessBerkas($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk menghapus data ini.');
        }

        DB::beginTransaction();
        try {
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

            $message = 'Berkas persyaratan berhasil dihapus!';
            if ($user->isWarga()) {
                $message = 'Berkas persyaratan Anda berhasil dihapus!';
            }

            // Redirect dengan parameter permohonan_id jika ada
            $redirectParams = [];
            if ($permohonanId) {
                $redirectParams['permohonan_id'] = $permohonanId;
            }

            return redirect()->route('berkas_persyaratan.index', $redirectParams)
                ->with('success', $message);

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
        $user = Auth::user();

        // Authorization check
        if ($user->isWarga() && !$user->canAccessBerkas($id)) {
            return abort(403, 'Anda tidak memiliki izin untuk mengakses data ini.');
        }

        $mediaFiles = Media::where('ref_table', 'berkas_persyaratan')
            ->where('ref_id', $id)
            ->orderBy('sort_order', 'asc')
            ->get();

        return view('pages.berkas_persyaratan.show', compact('berkas', 'mediaFiles'));
    }

    public function downloadFile($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        $user = Auth::user();

        // Authorization check
        if ($media->ref_table === 'berkas_persyaratan') {
            $berkas = BerkasPersyaratan::find($media->ref_id);
            if ($berkas && $user->isWarga() && !$user->canAccessBerkas($berkas->berkas_id)) {
                return abort(403, 'Anda tidak memiliki izin untuk mengakses file ini.');
            }
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
