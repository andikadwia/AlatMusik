<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

        public function index(Request $request)
    {
        $search = $request->input('search');
        
        $users = User::query()
            ->where('role', 'user')
            ->whereHas('pemesanan', function($query) {
                $query->where('status_penyewaan', 'sudah_dikembalikan');
            })
            ->when($search, function($query) use ($search) {
                return $query->where(function($q) use ($search) {
                    $q->where('name', 'like', '%'.$search.'%')
                      ->orWhere('email', 'like', '%'.$search.'%')
                      ->orWhere('telepon', 'like', '%'.$search.'%');
                });
            })
            ->with(['pemesanan' => function($query) {
                $query->where('status_penyewaan', 'sudah_dikembalikan')
                      ->with('pengembalian');
            }])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.dashboard.customer.index', [
            'users' => $users,
            'search' => $search,
            'statusFilter' => 'sudah_dikembalikan'
        ]);
    }

    public function create()
    {
        return view('pages.dashboard.customer.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|unique:pelanggan,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'id_pengguna' => 'nullable|exists:pengguna,id'
        ]);

        Pelanggan::create($validated);

        return redirect()->route('dashboard.pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function show(Pelanggan $pelanggan)
    {
        return view('pages.dashboard.customer.index', compact('pelanggan'));
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('pages.dashboard.customer.index', compact('pelanggan'));
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email|unique:pelanggan,email,'.$pelanggan->id,
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'id_pengguna' => 'nullable|exists:pengguna,id'
        ]);

        $pelanggan->update($validated);

        return redirect()->route('dashboard.pelanggan.index')
            ->with('success', 'Data pelanggan berhasil diperbarui');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return redirect()->route('dashboard.pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus');
    }
}