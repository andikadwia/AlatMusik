@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-8">
    <div class="container mx-auto px-4">
        <!-- Tombol Kembali ke Beranda -->
        <button onclick="window.location.href='{{ url('/') }}'" 
                class="mb-4 flex items-center px-4 py-2 bg-white text-primary border border-primary rounded-lg hover:bg-primary/10 transition-colors no-print">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </button>
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar Profile -->
            <div class="w-full md:w-64 lg:w-80 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-6 h-[calc(114vh-4rem)] flex flex-col">
                    <!-- User Profile Image and Info -->
                    <div class="flex flex-col items-center">
                        <div class="relative mb-4">
                            <img src="{{ $user->foto_profil ? asset($user->foto_profil) : asset('images/gitar.jpg') }}" 
                                alt="Foto Profil" 
                                class="w-24 h-24 rounded-full object-cover border-2 border-primary"
                                id="profile-image-preview">
                            <label for="foto_profil-upload" class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full cursor-pointer hover:bg-primary-dark transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </label>
                            <form id="profile-form" method="POST" action="{{ route('profile.update-profil') }}" enctype="multipart/form-data">
                                @csrf                   
                                <input type="file" id="foto_profil-upload" name="foto_profil" class="hidden" accept="image/jpeg,image/png,image/jpg">
                            </form>
                        </div>
                            @if($user->foto_profil)
                                <a href="{{ asset($user->foto_profil) }}" 
                                target="_blank" 
                                class="text-blue-500 text-sm">
                                    Lihat Foto Ukuran Penuh
                                </a>
                            @endif
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <h3 class="text-gray-600 text-sm">{{ '' . $user->email }}</h3>
                    </div>

                    <!-- Navigation Menu -->
                    <nav class="mt-8">
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile') }}" class="flex items-center px-4 py-2 text-primary bg-primary/10 rounded-lg font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Informasi Pribadi
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('riwayat') }}" class="flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Riwayat Sewa
                                </a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-gray-600 hover:text-primary hover:bg-gray-100 rounded-lg transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Profile Information Section -->
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Informasi Pribadi</h2>
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded text-sm">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Username Field -->
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone Field -->
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $user->telepon) }}" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('telepon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Field -->
                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea id="alamat" name="alamat" rows="3" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">{{ old('alamat', $user->alamat) }}</textarea>
                                @error('alamat')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Ubah Password</h2>

                    <form method="POST" action="{{ route('profile.update-password') }}">
                        @csrf

                        <div class="space-y-4">
                            <!-- Current Password Field -->
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                                <input type="password" id="current_password" name="current_password" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password Field -->
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                                <input type="password" id="password" name="password" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm New Password Field -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan modal konfirmasi -->
<div id="confirm-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-sm w-full">
        <h3 class="text-lg font-medium mb-4">Konfirmasi Ganti Foto Profil</h3>
        <p class="mb-6">Anda yakin ingin mengganti foto profil?</p>
        <div class="flex justify-end space-x-3">
            <button id="cancel-change" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                Batal
            </button>
            <button id="confirm-change" class="px-4 py-2 bg-primary text-white rounded-md hover:bg-primary-dark">
                Ya, Ganti
            </button>
        </div>
    </div>
</div>

<!-- Tambahkan notifikasi -->
@if(session('foto_updated'))
<div id="foto-notification" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg flex items-center">
    <span>Foto profil berhasil diubah!</span>
    <button onclick="document.getElementById('foto-notification').remove()" class="ml-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>
@endif

<!-- Script untuk konfirmasi dan preview -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fotoInput = document.getElementById('foto_profil-upload');
        const profileImage = document.getElementById('profile-image-preview');
        
        // Trigger file input ketika gambar profil diklik
        profileImage.addEventListener('click', function() {
            fotoInput.click();
        });

        // Preview gambar saat dipilih dan auto-submit
        fotoInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                
                // Validasi client-side
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!validTypes.includes(file.type)) {
                    alert('Hanya file JPEG/JPG/PNG yang diperbolehkan');
                    return;
                }
                
                if (file.size > 2 * 1024 * 1024) { // 2MB
                    alert('Ukuran file maksimal 2MB');
                    return;
                }
                
                // Tampilkan preview
                const reader = new FileReader();
                reader.onload = function(event) {
                    profileImage.src = event.target.result;
                };
                reader.readAsDataURL(file);
                
                // Auto-submit form
                document.getElementById('profile-form').submit();
            }
        });
    });
</script>
@endsection