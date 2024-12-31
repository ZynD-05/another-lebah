<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Sistem Monitoring Lebah</title>
  </head>
  <body>
    <h1 class="text-center mb-5">Rincian Data Koloni Lebah</h1>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10">
          <div class="card border rounded shadow">
            <div class="card-body">
              <a href="/datalebah" class="btn-close" aria-label="Close">x</a>

              <!-- Gambar Koloni -->
              <div class="mb-3 border rounded p-2">
                <label for="gambar" class="form-label fw-bold">Gambar Koloni</label><br>
                @if(file_exists(public_path('gambar/' . $data->gambar)) && $data->gambar)
                  <img src="{{ asset('gambar/' . $data->gambar) }}" alt="Gambar Koloni" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                @else
                  <img src="{{ asset('default-image.jpg') }}" alt="Default Gambar" class="img-thumbnail mb-3" style="width: 150px; height: auto;">
                @endif
              </div>

              <!-- Jenis Koloni -->
              <div class="mb-3 border rounded p-2">
                <label for="jenisLebah" class="form-label fw-bold">Jenis Koloni</label>
                <p id="jenis_lebah" class="form-control-plaintext mb-0">{{ $data->jenis_lebah }}</p>
              </div>

              <!-- Tanggal Pengadaan -->
              <div class="mb-3 border rounded p-2">
                <label for="tanggalPengadaan" class="form-label fw-bold">Tanggal Pengadaan</label>
                <p id="tanggal_pengadaan" class="form-control-plaintext mb-0">{{ $data->tanggal_pengadaan }}</p>
              </div>

              <!-- Catatan Kesehatan -->
              <div class="mb-3 border rounded p-2">
                <h5>Catatan Kesehatan</h5>
                @php
                  $catatanKesehatan = json_decode($data->catatan_kesehatan);
                @endphp
                <label for="kondisiLebah" class="form-label">Kondisi Lebah:</label>
                <p id="kondisiLebah" class="form-control-plaintext mb-0">{{ $catatanKesehatan->kondisiLebah ?? 'Tidak ada data' }}</p>
                <label for="kondisiCuaca" class="form-label mt-2">Kondisi Cuaca:</label>
                <p id="kondisiCuaca" class="form-control-plaintext mb-0">{{ $catatanKesehatan->kondisiCuaca ?? 'Tidak ada data' }}</p>
              </div>

              <!-- Riwayat Panen -->
              <div class="mb-3 border rounded p-2">
                <h5>Riwayat Panen</h5>
                @php
                  $catatanPanen = json_decode($data->catatan_panen);
                @endphp
                <label for="catatanPanen" class="form-label">Catatan Panen:</label>
                <p id="catatanPanen" class="form-control-plaintext mb-0">{{ $catatanPanen->catatanPanen ?? 'Tidak ada data' }}</p>
                <label for="hargaJual" class="form-label mt-2">Harga Jual:</label>
                <p id="hargaJual" class="form-control-plaintext mb-0">{{ $catatanPanen->hargaJual ? 'Rp. ' . number_format($catatanPanen->hargaJual, 0, ',', '.') : 'Tidak ada data' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>