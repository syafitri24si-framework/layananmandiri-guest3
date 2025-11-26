<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
        return view('pages.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:20',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|max:20',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('pages.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:20',
            'email'    => 'required|string|email|max:100|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|max:20',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus');
    }
}
