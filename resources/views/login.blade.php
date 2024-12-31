<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Sistem Monitoring Lebah</title>
  </head>
  <body>
    <h1 class="text-center mb-5">Rincian Data Koloni Lebah</h1>

    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10">
          <!-- Tambahkan border dan shadow pada card -->
          <div class="card border rounded shadow">
            <div class="card-body">
              <a href="/datalebah" class="btn-close" aria-label="Close">x</a>

              <!-- Gambar Koloni -->
              <div class="mb-3 border rounded p-2">
                <label for="gambar" class="form-label fw-bold">Gambar Koloni</label><br>
                @if(file_exists(public_path('gambarLebah/' . $data->gambar)) && $data->gambar)
                  <img src="{{ asset('gambarLebah/' . $data->gambar) }}" alt="Gambar Koloni" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                @else
                  <img src="{{ asset('default-image.jpg') }}" alt="Default Gambar" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                @endif
              </div>

              <!-- Jenis Koloni -->
              <div class="mb-3 border rounded p-2">
                <label for="jenisLebah" class="form-label fw-bold">Jenis Koloni</label>
                <p id="jenisLebah" class="form-control-plaintext mb-0">{{ $data->jenisLebah }}</p>
              </div>

              <!-- Tanggal Pengadaan -->
              <div class="mb-3 border rounded p-2">
                <label for="tanggalPengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
                <p id="tanggalPengadaan" class="form-control-plaintext mb-0">{{ $data->tanggalPengadaan }}</p>
              </div>

              <!-- Riwayat Panen -->
              <div class="mb-3 border rounded p-2">
                <label for="riwayatPanen" class="form-label fw-bold">Riwayat Panen</label>
                <p id="riwayatPanen" class="form-control-plaintext mb-0">{{ $data->riwayatPanen }}</p>
              </div>

              <!-- Catatan Kesehatan -->
              <div class="mb-3 border rounded p-2">
                <label for="catatanKesehatan" class="form-label fw-bold">Catatan Kesehatan</label>
                <p id="catatanKesehatan" class="form-control-plaintext mb-0">{{ $data->catatanKesehatan }}</p>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
