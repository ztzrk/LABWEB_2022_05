<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <script src="script.js"></script>
  </head>
  <body>
    <?php require_once 'process.php'; ?>

    <div class="container" id="outer">
    <?php 
    if (isset($_SESSION['pesan'])): ?>
    <div class="alert alert-<?=$_SESSION['alert-type']?>" role="alert">
      <?php
      echo $_SESSION['pesan'];
      unset($_SESSION['pesan']);
      ?>
    </div>
    <?php endif ?>
    <div class="container" id="form-mahasiswa">
      <?php if ($update == 0):?>
        <div class="h3">Masukkan data mahasiswa</div>
      <?php else: ?>
        <div class="h3">Edit data mahasiswa</div>
      <?php endif ?>

      <form action="process.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">

        <div class="mb-3 row form-group">
          <label class="col-sm-1 form-label">NIM*</label>
          <div class="col-sm-4">
            <input type="text" name="nim" class="form-control" value="<?php echo$nim; ?>" placeholder="Masukkan NIM">
          </div>
          <div class="col-sm-4">
          <?php 
            if (isset($_SESSION['nim'])): ?>
            <div class="p1">
              <?php
              echo $_SESSION['nim'];
              unset($_SESSION['nim']);
              ?>
            </div>
            <?php endif ?>
          </div>
        </div>

        <div class="mb-3 row form-group">
          <label class="col-sm-1 form-label">Nama*</label>
          <div class="col-sm-4">
            <input type="text" name="nama" class="form-control" value="<?php echo$nama; ?>" placeholder="Masukkan Nama">
          </div>
          <div class="col-sm-4">
          <?php 
            if (isset($_SESSION['nama'])): ?>
            <div class="p1">
              <?php
              echo $_SESSION['nama'];
              unset($_SESSION['nama']);
              ?>
            </div>
            <?php endif ?>
          </div>
        </div>

        <div class="mb-3 row form-group">
          <label for="kota" class="col-sm-1 form-label">Kota</label>
          <div class="col-sm-4">
            <input type="text" name="kota" class="form-control" value="<?php echo$kota; ?>" placeholder="Masukkan Kota Asal">
          </div>
          <div class="col-sm-4">
          <?php 
            if (isset($_SESSION['kota'])): ?>
            <div class="p1">
              <?php
              echo $_SESSION['kota'];
              unset($_SESSION['kota']);
              ?>
            </div>
            <?php endif ?>
          </div>
        </div>

        <div class="mb-3 row form-group">
          <label for="nim" class="col-sm-1 form-label">Fakultas*</label>
          <div class="col-sm-4">
            <select class="form-select form-select-sm" name="fakultas" id="js-fakultas">
              <?php if ($fakultas == "0"): ?>
                <option selected value="0">-- Pilih Fakultas --</option>
              <?php else:?>
                <option selected value="<?php echo $fakultas ?>"><?php echo $fakultas ?></option>
              <?php endif; ?>
              <?php 
              $j = 0;
              while ($j < sizeof($listFakultas)): ?>
                <option value="<?php echo $listFakultas[$j] ?>"><?php echo $listFakultas[$j] ?></option>
                <?php $j++; ?> 
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-sm-4">
          <?php 
            if (isset($_SESSION['fakultas'])): ?>
            <div class="p1">
              <?php
              echo $_SESSION['fakultas'];
              unset($_SESSION['fakultas']);
              ?>
            </div>
            <?php endif ?>
          </div>
        </div>

        <div class="form-group">
          <?php if ($update == 0):?>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan Data</button>
          <?php else: ?>
            <button type="submit" class="btn btn-primary" name="update">Update Data</button>
          <?php endif ?>
          <div class="form-text">Tanda * berarti data wajib diisi</div>
        </div>
      </form>
    </div>

    <div class="h4 bg-secondary p-2">Data Mahasiswa</div>
    <div class="container" id="tabel-mahasiswa">
      <?php
        $mysqli = new mysqli('localhost', 'root', '', 'praktikum-8') or die(mysqli_error($mysqli));
        $data_mahasiswa = $mysqli->query("SELECT * from data ORDER BY id DESC") or die($mysqli->error);
      ?>

      <table class="table">
        <thead>
          <tr class="text-center">
            <th>No</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Kota</th>
            <th>Fakultas</th>
            <th colspan="2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $i = 1;
            while ($line = $data_mahasiswa->fetch_assoc()): ?>
            <tr>
              <td class="text-center"><?php echo $i; $i++; ?></td>
              <td><?php echo $line['nim']?></td>
              <td><?php echo $line['nama']?></td>
              <td><?php echo $line['kota']?></td>
              <td><?php echo $line['fakultas']?></td>
              <td class="row justify-content-center">
                <a href="index.php?edit=<?php echo $line['id']; ?>" class="col btn btn-warning" id="edit-button">Edit</a>
                <a href="javascript: isDelete(<?php echo $line['id']; ?>)" class=" col btn btn-danger" id="js-hapus">Hapus</a>
                
              </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
      </table>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>