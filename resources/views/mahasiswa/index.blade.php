@extends('layouts.app')

@section('content')
<div class="bg-gray-900 text-white min-h-screen p-8 rounded-lg shadow-lg">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-4xl font-extrabold">📘 Data mahasiswa</h3>
        <a href="{{ route('mahasiswa.create') }}"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow-md transition">
            <i class="fas fa-plus mr-2"></i> Tambah mahasiswa
        </a>
    </div>

    <!-- Input Pencarian -->
    <div class="mb-4">
        <input type="text" id="searchInput"
            placeholder="Cari mahasiswa..."
            class="w-full px-4 py-2 rounded bg-gray-800 text-white border border-gray-600 focus:ring-2 focus:ring-indigo-500">
    </div>

    <div class="overflow-x-auto mt-6 rounded-lg shadow-inner">
        <table class="min-w-full bg-gray-800 text-white rounded-lg overflow-hidden">
            <thead class="bg-gray-700 uppercase text-sm tracking-wider text-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left">NPM</th>
                    <th class="px-6 py-3 text-left">Nama Mahasiswa</th>
                    <th class="px-6 py-3 text-left">Kode Kelas</th>
                    <th class="px-6 py-3 text-left">ID Prodi</th>
                    <th class="px-6 py-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody id="kelasTable" class="divide-y divide-gray-700">
                @if(isset($mahasiswas) && is_array($mahasiswas) && count($mahasiswas) > 0)
                @foreach($mahasiswas as $mahasiswa)
                <tr class="kelas-row">
                    <td class="px-6 py-4">{{ $mahasiswa['npm'] }}</td>
                    <td class="px-6 py-4">{{ $mahasiswa['nama_mhs'] }}</td>
                    <td class="px-6 py-4">{{ $mahasiswa['kode_kelas'] }}</td>
                    <td class="px-6 py-4">{{ $mahasiswa['id_prodi'] }}</td>
                    <td class="px-6 py-4 space-x-2">
                        <a href="{{ route('mahasiswa.edit', $mahasiswa['npm']) }}"
                            class="text-indigo-400 hover:text-indigo-200">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('mahasiswa.destroy', $mahasiswa['npm']) }}" method="POST"
                            class="inline-block"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-200">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-400">Tidak ada data mahasiswa</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- SCRIPT PENCARIAN -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('.kelas-row');

        searchInput.addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();

            rows.forEach(row => {
                const nama = row.cells[0].textContent.toLowerCase();
                const kode = row.cells[1].textContent.toLowerCase();
                const match = nama.includes(keyword) || kode.includes(keyword);
                row.style.display = match ? '' : 'none';
            });
        });
    });
</script>
@endsection