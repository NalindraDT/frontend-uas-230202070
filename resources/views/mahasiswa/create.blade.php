@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center">
    <h3 class="text-white text-3xl font-medium">Tambah mahasiswa</h3>
    <a href="{{ route('mahasiswa.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 border border-gray-500">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="mt-8">
    <div class="bg-gray-800 overflow-hidden shadow-xl rounded-lg border-2 border-gray-600">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="npm" class="block text-sm font-medium text-gray-300">NPM mahasiswa</label>
                        <input type="text" name="npm" id="npm"
                            value="{{ old('npm') }}"
                            class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('npm') border-red-500 @enderror"
                            required>
                        @error('npm')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_mhs" class="block text-sm font-medium text-gray-300">Nama mahasiswa</label>
                        <input type="text" name="nama_mhs" id="nama_mhs"
                            value="{{ old('nama_mhs') }}"
                            class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('nama_mhs') border-red-500 @enderror"
                            required>
                        @error('nama_mhs')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="kode_kelas" class="block text-sm font-medium text-gray-300">Kode Kelas</label>
                        <input type="text" name="kode_kelas" id="kode_kelas"
                            value="{{ old('kode_kelas') }}"
                            class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('kode_kelas') border-red-500 @enderror"
                            required>
                        @error('kode_kelas')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_prodi" class="block text-sm font-medium text-gray-300">ID Prodi</label>
                        <input type="text" name="id_prodi" id="id_prodi"
                            value="{{ old('id_prodi') }}"
                            class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('id_prodi') border-red-500 @enderror"
                            required>
                        @error('id_prodi')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border-2 border-indigo-500 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection