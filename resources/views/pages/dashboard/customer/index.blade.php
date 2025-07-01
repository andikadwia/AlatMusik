@extends('layouts.main')

@section('title', 'Inshony - Data Pelanggan')

@section('content')
<h1 class="text-2xl font-bold mb-6 text-center">Data Pelanggan</h1>
<div class="container mx-auto px-4 py-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#a08963]">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Nama Pengguna</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-200 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->username }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $user->telepon }}</td>
                    <td class="px-6 py-4">{{ $user->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <form action="{{ route('dashboard.pelanggan.index', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                        Tidak ada data pelanggan yang sudah mengembalikan alat sewa
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="px-6 py-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection