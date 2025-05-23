@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center">
    <h3 class="text-white text-3xl font-medium">Edit matkul</h3>
    <a href="{{ route('matkul.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 border border-gray-500">
        <i class="fas fa-arrow-left mr-2"></i> Kembali
    </a>
</div>

<div class="mt-8">
    <div class="bg-gray-800 overflow-hidden shadow-xl rounded-lg border-2 border-gray-600">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('matkul.update', $matkul['kode_matkul']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="kode_matkul" class="block text-sm font-medium text-gray-300">id prodi</label>
                        <input type="text" name="kode_matkul" id="kode_matkul" value="{{ $matkul['kode_matkul'] }}" class="mt-1 bg-gray-700 text-gray-400 block w-full shadow-sm sm:text-sm border-2 border-gray-500 rounded-md cursor-not-allowed" readonly>
                    </div>

                    <div>
                        <label for="nama_matkul" class="block text-sm font-medium text-gray-300">Nama matkul</label>
                        <input type="text" name="nama_matkul" id="nama_matkul" value="{{ old('nama_matkul', $matkul['nama_matkul']) }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('nama_matkul') border-red-500 @enderror" required>
                        @error('nama_matkul')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="sks" class="block text-sm font-medium text-gray-300">SKSl</label>
                        <input type="text" name="sks" id="sks" value="{{ old('sks', $matkul['sks']) }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('sks') border-red-500 @enderror" required>
                        @error('sks')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-300">Semester</label>
                        <input type="text" name="semester" id="semester" value="{{ old('semester', $matkul['semester']) }}" class="mt-1 block w-full bg-gray-900 text-white border-2 border-gray-500 rounded-md shadow-sm sm:text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-400 hover:border-gray-400 transition-colors @error('semester') border-red-500 @enderror" required>
                        @error('semester')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                </div>

                <div class="mt-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border-2 border-indigo-500 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i class="fas fa-save mr-2"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection