<?php
// app/Http\Controllers/RiwayatStatusController.php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\PermohonanSurat;
use App\Models\RiwayatStatusSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatStatusController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    // Inisialisasi query
    $query = RiwayatStatusSurat::with(['permohonan.warga', 'permohonan.jenisSurat', 'petugas']);

    // Filter berdasarkan role
    if ($user->isWarga()) {
        // Warga hanya bisa lihat riwayat miliknya
        $wargaData = $user->dataWarga();

        if ($wargaData) {
            $permohonanIds = $wargaData->permohonanSurat->pluck('permohonan_id');
            $query->whereIn('permohonan_id', $permohonanIds);
        } else {
            // Kembalikan PAGINATOR kosong
            $riwayatData = RiwayatStatusSurat::where('permohonan_id', 0)->paginate(15);
            $permohonanList = collect();

            return view('pages.riwayat_status.index', compact('riwayatData', 'permohonanList'));
        }
    }

        // Filter
        if ($request->filled('permohonan_id')) {
            $query->where('permohonan_id', $request->permohonan_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('waktu', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('waktu', '<=', $request->end_date);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('keterangan', 'like', '%' . $request->search . '%')
                    ->orWhereHas('petugas', function ($q2) use ($request) {
                        $q2->where('nama', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $riwayatData = $query->orderBy('waktu', 'desc')->paginate(15);

        // Permohonan list (hanya untuk admin atau permohonan milik warga)
        if ($user->isAdmin()) {
            $permohonanList = PermohonanSurat::with('warga')->get();
        } else {
            $wargaData = $user->dataWarga();
            $permohonanList = $wargaData ? $wargaData->permohonanSurat : collect();
        }

        return view('pages.riwayat_status.index', compact('riwayatData', 'permohonanList'));
    }

    public function upload(Request $request, $id)
    {
        $user = Auth::user();

        // Hanya admin yang bisa upload file riwayat
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat mengupload file riwayat.');
        }

        $request->validate([
            'files'   => 'required|array',
            'files.*' => 'file|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . $file->getClientOriginalName();

            $uploadPath = public_path('uploads/riwayat_status');
            if (! file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $file->move($uploadPath, $fileName);

            Media::create([
                'ref_table'  => 'riwayat_status_surat',
                'ref_id'     => $id,
                'file_name'  => $fileName,
                'caption'    => $request->caption,
                'mime_type'  => $file->getMimeType(),
                'sort_order' => 0,
            ]);
        }

        return back()->with('success', 'File berhasil diupload');
    }

    public function show($id)
    {
        $user = Auth::user();

        $data = RiwayatStatusSurat::with([
            'permohonan.warga',
            'permohonan.jenisSurat',
            'petugas',
            'mediaFiles',
        ])->findOrFail($id);

        // Authorization check untuk warga
        if ($user->isWarga()) {
            $permohonan = $data->permohonan;
            $wargaData = $user->dataWarga();

            if (!$permohonan || !$wargaData || $permohonan->warga_id != $wargaData->warga_id) {
                return abort(403, 'Anda tidak memiliki izin untuk mengakses data ini.');
            }
        }

        return view('pages.riwayat_status.show', compact('data'));
    }
}
