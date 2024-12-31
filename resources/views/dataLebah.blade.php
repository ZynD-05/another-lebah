<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Monitoring Lebah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .btn-custom-primary {
      background-color: #007bff;
      color: white;
    }

    .btn-custom-info {
      background-color: #17a2b8;
      color: white;
    }

    .btn-custom-danger {
      background-color: #dc3545;
      color: white;
    }

    .btn-rounded {
      border-radius: 30px;
    }
  </style>
</head>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Sistem Monitoring Lebah</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/datalebah">Data Lebah</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">grafik</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<body>
  <div class="container mt-5">
    <div class="row">
      <h1 class="text-center mb-3">Data Koloni Lebah</h1>

      <!-- Tambah Data Button -->
      <div class="text-start mb-3">
        <a href="/tambahdatalebah" class="btn btn-custom-primary btn-sm btn-rounded">Tambah Data</a>
      </div>

      <!-- Rincian Data -->
      <div class="card mt-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No Koloni</th>
              <th scope="col">Gambar</th>
              <th scope="col">Jenis Lebah</th>
              <th scope="col">Tanggal Pengadaan</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($data as $row)
            <tr>
              <th scope="row">{{ $no++ }}</th>
              <td>
                @if(file_exists(public_path('gambar/' . $row->gambar)) && $row->gambar)
                  <img src="{{ asset('gambar/'. $row->gambar) }}" alt="Gambar Lebah" style="width: 50px;">
                @else
                  <img src="{{ asset('default-image.jpg') }}" alt="Default Image" style="width: 50px;">
                @endif
              </td>
              <td>{{ $row->jenis_lebah }}</td>
              <td>{{ $row->tanggal_pengadaan }}</td>
              <td>
                <a href="/rinciandata/{{ $row->id }}" class="btn btn-custom-primary btn-sm btn-rounded">Tampilkan</a>
                <a href="/tampildata/{{ $row->id }}" class="btn btn-custom-info btn-sm btn-rounded">Ubah</a>
                <a href="javascript:void(0);" 
                   onclick="confirmDelete('/hapusdata/{{ $row->id }}')" class="btn btn-custom-danger btn-sm btn-rounded">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(deleteUrl) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = deleteUrl;
      }
    }
  </script>
</body>

</html>
