<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Database Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Database Mahasiswa</a>
            <form class="d-flex">
            <button class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#tambah" type="button">Tambah Data</button>
            </form>
        </div> 
    </nav>

    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Data Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="tambah" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">NIM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nim" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Fakultas</label>
                            <div class="col-sm-10">
                            <select class="form-select" name="fakultas" aria-label="Default select example" required>
                                <option value="-" selected>Open this select menu</option>
                                <option value="Ekonomi & Bisnis">Ekonomi & Bisnis</option>
                                <option value="Hukum">Hukum</option>
                                <option value="Kedokteran">Kedokteran</option>
                                <option value="Teknik">Teknik</option>
                                <option value="Ilmu Sosial dan Ilmu Politik">Ilmu Sosial dan Ilmu Politik</option>
                                <option value="Ilmu Budaya">Ilmu Budaya</option>
                                <option value="Matematika dan Ilmu Pengetahuan Alam">Matematika dan Ilmu Pengetahuan Alam</option>
                                <option value="Peternakan">Peternakan</option>
                                <option value="Kedokteran Gigi">Kedokteran Gigi</option>
                                <option value="Kesehatan Masyarakat">Kesehatan Masyarakat</option>
                                <option value="Ilmu Kelautan & Perikanan">Ilmu Kelautan & Perikanan</option>
                                <option value="Kehutanan">Kehutanan</option>
                                <option value="Farmasi">Farmasi</option>
                                <option value="Pasca Sarjana">Pasca Sarjana</option>
                                <option value="Keperawatan">Keperawatan</option>
                            </select>
                            </div>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary">Simpan Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-flex justify-content-center flex-column align-items-center mt-3">

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show w-75" role="alert">
            @foreach ($errors->all() as $error)
                <strong> {{$error}} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            @endforeach
    </div>
    @endif

            @if($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
                    <strong> {{$message}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($message = Session::get('exist'))
                <div class="alert alert-danger alert-dismissible fade show w-75" role="alert">
                    <strong> {{$message}} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Fakultas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>

            @foreach($data as $index => $item)

                <tr>
                    <td> {{ $index + $data->firstItem() }} </td>
                    <td> {{ Str::upper($item->nim) }} </td>
                    <td> {{ $item->nama }}</td>
                    <td> {{ $item->alamat }}</td>
                    <td> {{ $item->fakultas }}</td>
                    <td>
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit{{ $item->nim }}" type="button">Edit</button>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->nim }}" type="button">Hapus</button>
                        </div>
                    </td>
                </tr>

                <div class="modal fade" id="edit{{ $item->nim }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Edit Data Mahasiswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="edit/{{ $item->nim }}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">NIM</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ Str::upper($item->nim) }}" class="form-control" name="nim" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $item->nama }}" class="form-control" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="{{ $item->alamat }}" class="form-control" name="alamat" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label">Fakultas</label>
                                        <div class="col-sm-10">
                                        <select class="form-select" name="fakultas" aria-label="Default select example" required>
                                            <option selected>{{ $item->fakultas }}</option>
                                            <option value="Ekonomi & Bisnis">Ekonomi & Bisnis</option>
                                            <option value="Hukum">Hukum</option>
                                            <option value="Kedokteran">Kedokteran</option>
                                            <option value="Teknik">Teknik</option>
                                            <option value="Ilmu Sosial dan Ilmu Politik">Ilmu Sosial dan Ilmu Politik</option>
                                            <option value="Ilmu Budaya">Ilmu Budaya</option>
                                            <option value="Mipa">MIPA</option>
                                            <option value="Peternakan">Peternakan</option>
                                            <option value="Kedokteran Gigi">Kedokteran Gigi</option>
                                            <option value="Kesehatan Masyarakat">Kesehatan Masyarakat</option>
                                            <option value="Ilmu Kelautan & Perikanan">Ilmu Kelautan & Perikanan</option>
                                            <option value="Kehutanan">Kehutanan</option>
                                            <option value="Farmasi">Farmasi</option>
                                            <option value="Pasca Sarjana">Pasca Sarjana</option>
                                            <option value="Keperawatan">Keperawatan</option>
                                        </select>
                                        </div>
                                    </div>
                                    <button type="submit" name="edit" class="btn btn-primary">Simpan Data</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="hapus{{ $item->nim }}" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalLabel">Confirm</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Hapus Data {{ Str::upper($item->nim) }} ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a type="button" class="btn btn-danger" href="hapus/{{ $item->nim }}">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </tbody>
            @endforeach
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {!! $data->links() !!}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>