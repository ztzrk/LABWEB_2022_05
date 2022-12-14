<?php
require_once 'process.php';

class Mahasiswa {
    private $nim;
    private $nama;
    private $kota;
    private $fakultas;

    public function __construct($nim, $nama, $kota = '', $fakultas) {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->kota = $kota;
        $this->fakultas = $fakultas;
    }

    public function setData($nim, $nama, $kota, $fakultas) {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->kota = $kota;
        $this->fakultas = $fakultas;
    }

    public function inputData() {
        $isData = isi_data($this->nim, $this->nama, $this->kota, $this->fakultas);

        inputFunction($isData, $this->nim, $this->nama, $this->kota, $this->fakultas);
        
        header('location: data-mahasiswa.php');
    }
    
    public function hapusData() {
        $id = $_GET['hapus'];
        
        $mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));
        $mysqli = $mysqli->query("DELETE FROM data WHERE id='$id'") or die($mysqli->error);

        $_SESSION['pesan'] = "Data berhasil dihapus";
        $_SESSION['alert-type'] = "danger";

        header('location: data-mahasiswa.php');
    }

    public function editData($id) {
        $isData = isi_data($this->nim, $this->nama, $this->kota, $this->fakultas);
        updateFunction($isData, $this->nim, $this->nama, $this->kota, $this->fakultas, $id);
    }
}
?>