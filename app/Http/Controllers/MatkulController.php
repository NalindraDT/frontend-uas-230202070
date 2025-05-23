<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MatkulController extends Controller
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'http://localhost:8080/matakuliah';
    }

    public function index()
    {
        try {
            $response = Http::get($this->baseUrl);
            $matkulss = $response->json();

            return view('matkul.index', compact('matkulss'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error fetching data: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return view('matkul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required',
            'nama_matkul' => 'required',
            'sks' => 'required',
            'semester' => 'required',
        ]);

        try {
            $response = Http::asForm()->post($this->baseUrl, [
                'kode_matkul' => $request->kode_matkul,
                'nama_matkul' => $request->nama_matkul,
                'sks' => $request->sks,
                'semester' => $request->semester,
            ]);

            return redirect()->route('matkul.index')->with('success', 'matkul berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Error adding data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($kode_matkul)
    {
        try {
            $response = Http::get("{$this->baseUrl}/{$kode_matkul}");
            $matkul = $response->json();
            $matkul = $matkul[0] ?? null;

            if (!$matkul) {
                return back()->with('error', 'Data prodi tidak ditemukan');
            }

            return view('matkul.edit', compact('matkul'));
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengambil data: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $kode_matkul)
    {
        $request->validate([
            'nama_matkul' => 'required',
            'sks' => 'required',
            'semester' => 'required',

        ]);

        try {
            $response = Http::put("{$this->baseUrl}/{$kode_matkul}", [
                'kode_matkul' => $kode_matkul,
                'nama_matkul' => $request->nama_matkul,
                'sks' => $request->sks,
                'semester' => $request->semester,
            ]);

            return redirect()->route('matkul.index')->with('success', 'matkul berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($kode_matkul)
    {
        try {
            $response = Http::delete("{$this->baseUrl}/{$kode_matkul}");

            return redirect()->route('matkul.index')->with('success', 'matkul berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting data: ' . $e->getMessage());
        }
    }
}
