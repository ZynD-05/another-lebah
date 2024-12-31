<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Sistem Monitoring Lebah</title>
  </head>
  <body>
    <h1 class="text-center mb-5">Ubah Data Koloni</h1>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-10">
          <div class="card">
            <div class="card-body">
              <form action="/ubahdata/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <a href="/datalebah" class="btn-close" aria-label="Close">x</a>

                <!-- Jenis Koloni -->
                <div class="mb-3">
                  <label for="jenisLebah" class="form-label">Jenis Koloni</label>
                  <input type="text" name="jenisLebah" class="form-control" id="jenis_lebah" value="{{ $data->jenis_lebah }}">
                </div>

                <!-- Tanggal Pengadaan -->
                <div class="mb-3">
                  <label for="tanggalPengadaan" class="form-label">Tanggal Pengadaan</label>
                  <input type="date" name="tanggalPengadaan" class="form-control" id="tanggal_pengadaan" value="{{ $data->tanggal_pengadaan }}">
                </div>

                <!-- Catatan Kesehatan -->
                <div class="mb-3">
                  <h5>Catatan Kesehatan</h5>
                  <label for="kondisiLebah" class="form-label">Kondisi Lebah</label>
                  <textarea name="kondisiLebah" class="form-control" id="kondisiLebah" rows="2">{{ json_decode($data->catatan_kesehatan)->kondisiLebah ?? '' }}</textarea>
                  <label for="kondisiCuaca" class="form-label mt-2">Kondisi Cuaca</label>
                  <textarea name="kondisiCuaca" class="form-control" id="kondisiCuaca" rows="2">{{ json_decode($data->catatan_kesehatan)->kondisiCuaca ?? '' }}</textarea>
                </div>

                <!-- Catatan Panen -->
                <div class="mb-3">
                  <h5>Catatan Panen</h5>
                  <label for="catatanPanen" class="form-label">Catatan Panen</label>
                  <textarea name="catatanPanen" class="form-control" id="catatanPanen" rows="2">{{ json_decode($data->catatan_panen)->catatanPanen ?? '' }}</textarea>
                  <label for="hargaJual" class="form-label mt-2">Harga Jual</label>
                  <input type="number" name="hargaJual" class="form-control" id="hargaJual" value="{{ json_decode($data->catatan_panen)->hargaJual ?? '' }}">
                </div>

                <!-- Gambar Koloni -->
                <div class="mb-3">
                  <label for="gambar" class="form-label">Gambar Koloni</label><br>
                  @if(file_exists(public_path('gambar/' . $data->gambar)) && $data->gambar)
                    <img src="{{ asset('gambar/' . $data->gambar) }}" alt="Gambar Koloni" class="img-thumbnail mb-3" style="width: 150px;">
                  @else
                    <img src="{{ asset('default-image.jpg') }}" alt="Default Gambar" class="img-thumbnail mb-3" style="width: 150px;">
                  @endif
                  <input type="file" name="gambar" class="form-control" id="gambar">
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-success">Simpan</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>