## Cara menjalanakan projek

### 1. GIT CLONE repo backend ini
```
https://github.com/Arfilal/backend_sinilai.git
```

### 2. Pastikan .env sudah diatur sesuai kebutuhan
### 3. ubah beberapa kode di backend untuk menghindari error karena foreign key:

- MahasiswaController:
```php
<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelMahasiswa;

class Mahasiswa extends BaseController
{
    use ResponseTrait;
    protected $model;

    function __construct()
    {
        $this->model = new ModelMahasiswa();
    }

    public function index()
    {
        $data = $this->model->orderBy('nama_mhs', 'asc')->findAll();
        return $this->respond($data, 200);
        
    }

    public function create()
    {
        // Ambil data dari request
        $npm = $this->request->getVar('npm');
        $nama_mhs = $this->request->getVar('nama_mhs');
        $kode_kelas = $this->request->getVar('kode_kelas');
        $id_prodi = $this->request->getVar('id_prodi');

        // Pastikan data valid
        if (empty($npm) || empty($nama_mhs)) {
            return $this->response->setJSON(['error' => 'Data tidak lengkap']);
        }

        // Masukkan data ke dalam model
        $data = [
            'npm' => $npm,
            'nama_mhs' => $nama_mhs,
            'kode_kelas' => $kode_kelas,
            'id_prodi' => $id_prodi,

        ];

        // Insert data ke database
        if ($this->model->insert($data)) {
            return $this->response->setJSON(['message' => 'Aspirasi berhasil dikirim']);
        } else {
            return $this->response->setJSON(['error' => 'Gagal mengirim aspirasi']);
        }
    }

    public function show($npm)
    {
        $mahasiswa = $this->model->find($npm);
        if (!$mahasiswa) {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Data tidak ditemukan']);
        }
        return $this->response->setJSON($mahasiswa);
    }

    public function update($npm)
    {
        // Ambil data dari request
        $nama_mhs = $this->request->getVar('nama_mhs');
        $kode_kelas = $this->request->getVar('kode_kelas');
        $id_prodi = $this->request->getVar('id_prodi');

        // Validasi data
        if (!$this->validate([
            'nama_mhs' => 'required|min_length[3]',
            'kode_kelas' => 'required',
            'id_prodi' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Cek apakah data mahasiswa dengan npm tersebut ada
        $existing = $this->model->where('npm', $npm)->first();
        if (!$existing) {
            return $this->failNotFound("Data tidak ditemukan untuk NPM $npm");
        }

        // Data yang akan diperbarui
        $data = [
            'nama_mhs' => $nama_mhs,
            'kode_kelas' => $kode_kelas,
            'id_prodi' => $id_prodi
        ];

        // Update data
        $updated = $this->model->update($npm, $data);

        if ($updated) {
            return $this->respond([
                'status' => 200,
                'messages' => ['success' => "Data berhasil diperbarui"]
            ]);
        }

        return $this->fail("Gagal memperbarui data.");
    }

    public function delete($npm)
    {
        // Cari data mahasiswa berdasarkan npm
        $data = $this->model->where('npm', $npm)->first();

        // Cek apakah data mahasiswa ditemukan
        if ($data) {
            // Hapus data mahasiswa berdasarkan npm
            $this->model->where('npm', $npm)->delete();

            // Response sukses jika data berhasil dihapus
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => "Data mahasiswa dengan NPM $npm berhasil dihapus"
                ]
            ];
            return $this->respond($response);
        } else {
            // Jika data mahasiswa tidak ditemukan
            return $this->failNotFound("Data mahasiswa dengan NPM $npm tidak ditemukan");
        }
    }

    // 🔥 Menambahkan fungsi untuk mendapatkan data mahasiswa dengan prodi dan kelas
    public function getMahasiswaWithProdi()
    {
        $data = $this->model->getMahasiswaWithProdi();

        if ($data) {
            return $this->respond($data, 200);
        } else {
            return $this->failNotFound("Data mahasiswa tidak ditemukan.");
        }
    }
}
```

- ModelMahasiswa :
```php
<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelMahasiswa extends Model
{
    protected $table = "mahasiswa";
    protected $primaryKey = "npm";
    protected $allowedFields = ['npm', 'nama_mhs', 'kode_kelas', 'id_prodi'];

    protected $validationRules = [
        'npm' => 'required',
        'nama_mhs' => 'required',
        'kode_kelas' => 'required',
        'id_prodi' => 'required',
    ];

    protected $validationMessages = [
        'npm' => ['required' => 'Silahkan masukkan NPM'],
        'nama_mhs' => ['required' => 'Silahkan masukkan nama mahasiswa'],
        'kode_kelas' => ['required' => 'Silahkan masukkan kode kelas'],
        'id_prodi' => ['required' => 'Silahkan masukkan ID prodi'],
    ];

    // 🔥 Fungsi untuk mendapatkan data mahasiswa dengan informasi prodi dan kelas
    public function getMahasiswaWithProdi()
    {
        return $this->db->table('mahasiswa m')
            ->select([
                'm.npm',
                'm.nama_mhs',
                'm.kode_kelas',
                'm.id_prodi',
                'm.nama_prodi'
            ])
            // ->join('prodi p', 'm.id_prodi = p.id_prodi')
            // ->join('kelas k', 'm.kode_kelas = k.kode_kelas')
            // ->distinct()
            ->orderBy('m.npm', 'ASC')
            ->get()
            ->getResultArray();
    }
}
```


## 2. Ambil database dari repo ini

```
https://github.com/HanaKurnia/database_pbf
```
Cukup ambil 2 table yaitu

```sql
CREATE TABLE mahasiswa (
    npm VARCHAR(15) PRIMARY KEY,
    nama_mhs VARCHAR(100) NOT NULL,
    kode_kelas VARCHAR(10),
    id_prodi INT,
    FOREIGN KEY (kode_kelas) REFERENCES kelas(kode_kelas) ON DELETE SET NULL,
    FOREIGN KEY (id_prodi) REFERENCES prodi(id_prodi) ON DELETE SET NULL
);

CREATE TABLE mata_kuliah (
    kode_matkul VARCHAR(10) PRIMARY KEY,
    nama_matkul VARCHAR(100) NOT NULL,
    semester INT NOT NULL,
    sks INT NOT NULL CHECK (sks > 0)
);
```

## 3. Git clone front end ini
```
https://github.com/NalindraDT/frontend-uas-230202070.git
```

## 4. Jalankan composer install dan atur env, session driver menjadi file