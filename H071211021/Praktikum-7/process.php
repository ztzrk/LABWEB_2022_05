<?php 
require_once 'mahasiswa.php';

$id = 0;
$nim = '';
$nama = '';
$kota = '';
$fakultas = '0';
$listFakultas = ["Ekonomi dan Bisnis", "Hukum", "Kedokteran", "Teknik", "Ilmu Sosial dan Ilmu Politik", "Ilmu Budaya", 
"Pertanian", "Matematika dan Ilmu Pengetahuan Alam", "Peternakan", "Kedokteran Gigi", "Kesehatan Masyarakat",
"Ilmu Kelautan dan Perikanan", "Kehutanan", "Farmasi", "Keperawatan"];
$update = 0;
$mahasiswa = new Mahasiswa($nim, $nama, $kota, $fakultas);

$mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kota = $_POST['kota'];
    $fakultas = $_POST['fakultas'];

    $mahasiswa->setData($nim, $nama, $kota, $fakultas);
    $mahasiswa->inputData();
}

else if (isset($_GET['hapus'])) {
    $mahasiswa->hapusData();
}

if (isset($_GET['edit'])) {
    $update = 1;
    $id = $_GET['edit'];
    $data = $mysqli->query("SELECT * FROM data WHERE id='$id'") or die($mysqli->error);

    $line = $data->fetch_array();
    $nim = $line['nim'];
    $nama = $line['nama'];
    $kota = $line['kota'];
    $fakultas = $line['fakultas'];
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kota = $_POST['kota'];
    $fakultas = $_POST['fakultas'];

    $mahasiswa->setData($nim, $nama, $kota, $fakultas);

    $mahasiswa->editData($id);
}

function isi_data($nim, $nama, $kota, $fakultas) {
    $isData = [];
    $isData[0] = true;
    $isData[1] = true;
    $isData[2] = true;
    $isData[3] = true;
    
    if ((!ctype_alnum(str_replace(' ', '', $nim)))||empty($nim)) {
        $isData[0] = false;
    }
    if ((!ctype_alpha(str_replace(' ', '', $nama)))||empty($nama)) {
        $isData[1] = false;
    }

    if (empty($kota)) {
        $isData[2] = true;
    } else if (!ctype_alpha(str_replace(' ', '', $kota))) {
        $isData[2] = false;
    }

    if ($fakultas=="0") {
        $isData[3] = false;
    }
    
    return $isData;
}

function isNimSama($nim) {
    $mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT nim FROM data WHERE nim = '$nim'");
    if($result->num_rows == 0) {
        return false;
        $mysqli->close();
    } else {
        return true;
        $mysqli->close();
    }
}

function inputFunction($isData, $nim, $nama, $kota, $fakultas) {
    $mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));
    if($isData[0] && $isData[1] && $isData[2] && !isNimSama($nim)) {
        $mysqli->query("INSERT INTO data(nim, nama, kota, fakultas) values ('$nim', '$nama', '$kota', '$fakultas')") or die($mysqli->error);
        $_SESSION['pesan'] = "Data berhasil disimpan";
        $_SESSION['alert-type'] = "success";
        
    }
    else {
        if (isNimSama($nim)) {
            $_SESSION['nim'] = "NIM sudah ada di data";
        }
        if (!$isData[0]) {
            if (empty($nim)) {
                $_SESSION['nim'] = "NIM harus diisi";
            } 
            else {  
                $_SESSION['nim'] = "NIM harus berupa angka dan alfabet";
            }
        }
        if (!$isData[1]) {
            if (empty($nama)) {
                $_SESSION['nama'] = "Nama harus diisi";
            }
            else {  
                $_SESSION['nama'] = "Nama harus berupa alfabet";
            }
        }
        if (!$isData[2]) {
            $_SESSION['kota'] = "Kota harus berupa alfabet";
        }
        if (!$isData[3]) {
            $_SESSION['fakultas'] = "Fakultas harus diisi";
        }
    }
    $mysqli->close();
}

function updateFunction($isData, $nim, $nama, $kota, $fakultas, $id) {
    $mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));
    if($isData[0] && $isData[1] && $isData[2]) {
        $mysqli->query("UPDATE data set nim = '$nim', nama = '$nama', kota = '$kota', fakultas = '$fakultas' WHERE id = '$id'") or die($mysqli->error);
        $_SESSION['pesan'] = "Data berhasil diubah";
        $_SESSION['alert-type'] = "success";
        header("location: data-mahasiswa.php");
    }
    else {
        if (!$isData[0]) {
            if (empty($nim)) {
                $_SESSION['nim'] = "NIM harus diisi";
            } 
            else {  
                $_SESSION['nim'] = "NIM harus berupa angka dan alfabet";
            }
        }
        if (!$isData[1]) {
            if (empty($nama)) {
                $_SESSION['nama'] = "Nama harus diisi";
            }
            else {  
                $_SESSION['nama'] = "Nama harus berupa alfabet";
            }
        }
        if (!$isData[2]) {
            $_SESSION['kota'] = "Kota harus berupa alfabet";
        }
        if (!$isData[3]) {
            $_SESSION['fakultas'] = "Fakultas harus diisi";
        }
        header("location: data-mahasiswa.php?edit=$id");
    }
    $mysqli->close();
}

?>