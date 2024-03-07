<?php

class MataKuliah {
    protected $kode;
    protected $nama;
    protected $sks;

    public function __construct($kode, $nama, $sks) {
        $this->kode = $kode;
        $this->nama = $nama;
        $this->sks = $sks;
    }

    public function getSks() {
        return $this->sks;
    }

    public function getInfo() {
        return "<tr><td>{$this->kode}</td><td>{$this->nama}</td><td>{$this->sks}</td></tr>";
    }
}

class MataKuliahWajib extends MataKuliah {
    private $jenis;

    public function __construct($kode, $nama, $sks, $jenis) {
        parent::__construct($kode, $nama, $sks);
        $this->jenis = $jenis;
    }

    public function getInfo() {
        return "<tr><td>{$this->kode}</td><td>{$this->nama}</td><td>{$this->sks}</td><td>{$this->jenis}</td></tr>";
    }
}

class MataKuliahPilihan extends MataKuliah {
    private $jenis;

    public function __construct($kode, $nama, $sks, $jenis) {
        parent::__construct($kode, $nama, $sks);
        $this->jenis = $jenis;
    }

    public function getInfo() {
        return "<tr><td>{$this->kode}</td><td>{$this->nama}</td><td>{$this->sks}</td><td>{$this->jenis}</td></tr>";
    }
}

class Mahasiswa {
    private $nama;
    private $nim;
    private $mataKuliahWajib = [];
    private $mataKuliahPilihan = [];
    private $dosenWali;

    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim = $nim;
    }

    public function setDosenWali($dosenWali) {
        $this->dosenWali = $dosenWali;
    }

    public function daftarMataKuliahWajib(MataKuliahWajib $mataKuliah) {
        $this->mataKuliahWajib[] = $mataKuliah;
    }

    public function daftarMataKuliahPilihan(MataKuliahPilihan $mataKuliah) {
        $this->mataKuliahPilihan[] = $mataKuliah;
    }

    public function getInfo() {
        $infoDosenWali = "<tr><td colspan='4'><strong>Dosen Wali: {$this->dosenWali}</strong></td></tr>";
        $infoMahasiswa = "<tr><td colspan='4'><strong>Nama: {$this->nama}, NIM: {$this->nim}</strong></td></tr>";
        $infoMataKuliahWajib = "<tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Jenis</th></tr>";
        $infoMataKuliahPilihan = "<tr><th>Kode</th><th>Nama</th><th>SKS</th><th>Jenis</th></tr>";

        $totalSksWajib = 0;
        $totalSksPilihan = 0;

        foreach ($this->mataKuliahWajib as $mataKuliah) {
            $infoMataKuliahWajib .= $mataKuliah->getInfo();
            $totalSksWajib += $mataKuliah->getSks();
        }

        foreach ($this->mataKuliahPilihan as $mataKuliah) {
            $infoMataKuliahPilihan .= $mataKuliah->getInfo();
            $totalSksPilihan += $mataKuliah->getSks();
        }

        $totalSks = $totalSksWajib + $totalSksPilihan;

        $infoTotalSks = "<tr><td colspan='2'><strong>Total SKS Wajib:</strong></td><td colspan='2'>$totalSksWajib</td></tr>";
        $infoTotalSks .= "<tr><td colspan='2'><strong>Total SKS Pilihan:</strong></td><td colspan='2'>$totalSksPilihan</td></tr>";
        $infoTotalSks .= "<tr><td colspan='2'><strong>Total SKS:</strong></td><td colspan='2'>$totalSks</td></tr>";

        return "
        <h1 style='text-align: center;'>Kartu Rencana Studi</h1>
        <h2 style='text-align: center;'>Universitas Merdeka Pasuruan</h2>
        <h3 style='text-align: center;'>Tahun Akademik 2023/2024 - Genap</h3>
        <table border='1' style='margin: 0 auto;'>$infoDosenWali $infoMahasiswa $infoMataKuliahWajib $infoMataKuliahPilihan $infoTotalSks</table>
        <div style='text-align: center; margin-top: 20px;'><button>Ajukan</button></div>
        ";
    }
}

// Instansiasi dan pendaftaran mata kuliah seperti sebelumnya
$mataKuliahWajib1 = new MataKuliahWajib('MK001', 'Manajemen Proyek Perangkat Lunak', 3, 'Wajib');
$mataKuliahWajib2 = new MataKuliahWajib('MK002', 'Sistem Rekomendasi', 3, 'Wajib');
$mataKuliahWajib3 = new MataKuliahWajib('MK003', 'Sistem terdistribusi', 3, 'Wajib');
$mataKuliahWajib4 = new MataKuliahWajib('MK004', 'Keamanan Informasi', 3, 'Wajib');
$mataKuliahPilihan1 = new MataKuliahPilihan('MK100', 'Magang', 5, 'Pilihan');
$mataKuliahPilihan2 = new MataKuliahPilihan('MK101', 'KKN - t', 3, 'Pilihan');

// Instansiasi mahasiswa
$mahasiswa = new Mahasiswa('Rizki Ikhwan Pamuji', '2155201001061');
$mahasiswa->setDosenWali('Nanda Martyan Anggadimas, S.T., M.T.');

// Pendaftaran mata kuliah untuk mahasiswa
$mahasiswa->daftarMataKuliahWajib($mataKuliahWajib1);
$mahasiswa->daftarMataKuliahWajib($mataKuliahWajib2);
$mahasiswa->daftarMataKuliahWajib($mataKuliahWajib3);
$mahasiswa->daftarMataKuliahWajib($mataKuliahWajib4);
$mahasiswa->daftarMataKuliahPilihan($mataKuliahPilihan1);
$mahasiswa->daftarMataKuliahPilihan($mataKuliahPilihan2);

// Menampilkan informasi mahasiswa
echo $mahasiswa->getInfo();

?>
