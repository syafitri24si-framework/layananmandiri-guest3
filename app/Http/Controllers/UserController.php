<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Hanya admin yang bisa lihat semua user
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
        }

        $query = User::query();

        // Apply filters
        if ($request->filled('name')) {
            $query->where('name', $request->input('name'));
        }

        if ($request->filled('email')) {
            $query->where('email', $request->input('email'));
        }

        // Apply search
        $searchableColumns = ['name', 'email'];
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm, $searchableColumns) {
                foreach ($searchableColumns as $column) {
                    $q->orWhere($column, 'like', '%' . $searchTerm . '%');
                }
            });
        }

        // Get unique values for dropdown filters
        $data['user_names'] = User::select('name')->distinct()->orderBy('name')->pluck('name');
        $data['user_emails'] = User::select('email')->distinct()->orderBy('email')->pluck('email');

        $data['user'] = $query->paginate(12);
        $data['filters'] = $request->all();

        return view('pages.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Hanya admin yang bisa buat user
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menambah user.');
        }

        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Hanya admin yang bisa buat user
        if (!$user->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menambah user.');
        }

        // Validasi input
        $validated = $request->validate([
            'name'     => 'required|string|max:20',
            'email'    => 'required|string|email|max:100|unique:users',
            'role'     => 'required|string|in:Admin,Warga',
            'password' => 'required|string|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|same:password',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // ✅ TAMBAH VALIDASI
        ]);

        // Upload foto profil jika ada
        if ($request->hasFile('profile_picture')) {
            // Validasi file gambar
            $request->validate([
                'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
            ]);

            // Simpan file ke storage
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Hash password
        $validated['password'] = Hash::make($validated['password']);

        // Hapus field konfirmasi password karena tidak perlu di database
        unset($validated['password_confirmation']);

        // Buat user
        $user = User::create($validated);

        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Admin bisa lihat semua, warga hanya bisa lihat data sendiri
        if ($currentUser->isWarga() && $currentUser->id != $id) {
            return abort(403, 'Anda hanya dapat melihat data Anda sendiri.');
        }

        return view('pages.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Admin bisa edit semua, warga hanya bisa edit data sendiri
        if ($currentUser->isWarga() && $currentUser->id != $id) {
            return abort(403, 'Anda hanya dapat mengedit data Anda sendiri.');
        }

        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Admin bisa update semua, warga hanya bisa update data sendiri
        if ($currentUser->isWarga() && $currentUser->id != $id) {
            return abort(403, 'Anda hanya dapat mengupdate data Anda sendiri.');
        }

        // Validasi
        $validated = $request->validate([
            'name'     => 'required|string|max:20',
            'email'    => 'required|string|email|max:100|unique:users,email,' . $id,
            'role'     => $currentUser->isAdmin() ? 'required|string|in:Admin,Warga' : 'nullable',
            'password' => 'nullable|string|min:8|max:20',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Upload foto profil baru jika ada
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            $user->deleteProfilePicture();

            // Simpan file baru
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }
        // Hapus foto jika user memilih checkbox "hapus foto"
        elseif ($request->has('remove_profile_picture')) {
            $user->deleteProfilePicture();
            $validated['profile_picture'] = null;
        }

        // Update password jika diisi
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Warga tidak bisa ubah role
        if ($currentUser->isWarga()) {
            unset($validated['role']);
        }

        $user->update($validated);

        $message = 'Data user berhasil diperbarui!';
        if ($currentUser->isWarga()) {
            $message = 'Data profil Anda berhasil diperbarui!';
        }

        return redirect()->route('user.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        // Hanya admin yang bisa hapus user
        if (!$currentUser->isAdmin()) {
            return abort(403, 'Hanya admin yang dapat menghapus user.');
        }

        // Tidak boleh hapus diri sendiri
        if ($currentUser->id == $id) {
            return redirect()->route('user.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Hapus foto profil jika ada
        $user->deleteProfilePicture();

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
