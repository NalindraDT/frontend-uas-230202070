@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h3 class="text-white text-3xl font-medium">Tambah prodi</h3>
        <a href="{{ route('matkul.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 border border-gray-500">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="mt-8">
        <div class="bg-gray-800 overflow-hidden shadow-xl rounded-lg border-2 border-gray-600">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('matkul.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="nama_matkul" class="block text-sm font-medium text-gray-300">nama matkul</label>
                            <input type="text" name="nama_matkul" id="nama_matkul" value="{{ old('nama_matkul') }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('nama_matkul') border-red-500 @enderror" required>
                            @error('nama_matkul')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="kode_matkul" class="block text-sm font-medium text-gray-300">Kode matkul</label>
                            <input type="text" name="kode_matkul" id="kode_matkul" value="{{ old('kode_matkul') }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('kode_matkul') border-red-500 @enderror" required>
                            @error('kode_matkul')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="sks" class="block text-sm font-medium text-gray-300">SKS</label>
                            <input type="text" name="sks" id="sks" value="{{ old('sks') }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('sks') border-red-500 @enderror" required>
                            @error('sks')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-300">Semester</label>
                            <input type="text" name="semester" id="semester" value="{{ old('semester') }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('semester') border-red-500 @enderror" required>
                            @error('semester')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border-2 border-indigo-500 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <i class="fas fa-save mr-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection