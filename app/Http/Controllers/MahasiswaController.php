<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8080/mahasiswa';
    }

    public function index()
    {
        try {
            $response = Http::get($this->baseUrl);
            $mahasiswas = $response->json();

            return view('mahasiswa.index', compact('mahasiswas'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'npm' => 'required',
            'nama_mhs' => 'required',
            'kode_kelas' =>'required',
            'id_prodi' =>'required',

        ]);

        try {
            $response = Http::post($this->baseUrl, [
                'npm' => $request->npm,
                'nama_mhs' => $request->nama_mhs,
                'kode_kelas' => $request->kode_kelas,
                'id_prodi' => $request->id_prodi,
            ]);

            return redirect()->route('mahasiswa.index')->with('success', 'mahasiswa berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Error adding data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($npm)
    {
        try {
            $response = Http::get("{$this->baseUrl}/{$npm}");
            $npm = $response->json();
            $npm = $npm[0] ?? null;

            if (!$npm) {
                return back()->with('error', 'npm tidak ditemukan');
            }

            return view('mahasiswa.edit', compact('npm'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $npm)
    {
        $request->validate([
            'npm' => 'required',
            'nama_mhs' => 'required',
            'kode_kelas' =>'required',
            'id_prodi' =>'required',
        ]);

        try {
            $response = Http::put("{$this->baseUrl}/{$npm}", [
                'nama_mhs' => $request->nama_mhs,
                'kode_kelas' => $request->kode_kelas,
                'id_prodi' => $request->id_prodi,
                'npm' => $npm,
            ]);

            return redirect()->route('mahasiswa.index')->with('success', 'mahasiswa berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($npm)
    {
        try {
            $response = Http::delete("{$this->baseUrl}/{$npm}");

            return redirect()->route('mahasiswa.index')->with('success', 'mahasiswa berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }
}
