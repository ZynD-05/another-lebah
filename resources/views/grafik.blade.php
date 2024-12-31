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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
</head>

<body>
  <div class="container mt-5">
    <div class="row">
      <h1 class="text-center mb-3">Sistem Monitoring Lebah</h1>

      <!-- Tambah Data Button -->
      <div class="text-start mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="/tambahdatapanen" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="idKoloni" class="form-label">ID Koloni</label>
                  <select name="idKoloni" id="idKoloni" class="form-select" required>
                    <option value="" disabled selected>Pilih ID Koloni</option>
                    @foreach ($datalebah as $lebah)
                      <option value="{{ $lebah->id }}">{{ $lebah->id }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="jenisKoloni" class="form-label">Jenis Koloni</label>
                  <select name="jenisKoloni" id="jenisKoloni" class="form-select" required>
                    <option value="" disabled selected>Pilih Jenis Koloni</option>
                    @foreach ($datalebah as $lebah)
                      <option value="{{ $lebah->jenisKoloni }}">{{ $lebah->jenisKoloni }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label for="tanggalPengadaan" class="form-label">Tanggal Pengadaan</label>
                  <input type="date" name="tanggalPengadaan" class="form-control" id="tanggalPengadaan" required>
                </div>
                <div class="mb-3">
                  <label for="jumlahMadu" class="form-label">Jumlah Madu</label>
                  <input type="text" name="jumlahMadu" class="form-control" id="jumlahMadu" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Rincian Data -->
      <div class="card mt-3">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">No Koloni</th>
              <th scope="col">Jenis Koloni</th>
              <th scope="col">Tanggal Panen</th>
              <th scope="col">Jumlah Madu</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
              $no = 1;
            @endphp
            @foreach ($data as $row)
            <tr>
              <td>{{ $row->idKoloni }}</td>
              <td>{{ $row->jenisKoloni }}</td>
              <td>{{ $row->tanggal_panen }}</td>
              <td>{{ $row->jumlahMadu }}</td>
              <td>
                <a href="/tampildatapanen/{{ $row->id }}" class="btn btn-custom-info btn-sm btn-rounded">Ubah</a>
                <a href="javascript:void(0);" 
                   onclick="confirmDelete('/hapusdatapanen/{{ $row->id }}')" class="btn btn-custom-danger btn-sm btn-rounded">Hapus</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Grafik -->
      <div class="mt-5">
        <div id="container" style="width:100%; height:400px;"></div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const dataMadu = []; // Data kosong untuk grafik

      Highcharts.chart('container', {
        chart: {
          type: 'column'
        },
        title: {
          text: 'Produksi Madu per Bulan'
        },
        subtitle: {
          text: 'Source: Sistem Monitoring Lebah'
        },
        xAxis: {
          categories: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
          crosshair: true
        },
        yAxis: {
          min: 0,
          title: {
            text: 'Jumlah Madu (Ml)'
          }
        },
        tooltip: {
          valueSuffix: ' Ml'
        },
        plotOptions: {
          column: {
            pointPadding: 0.2,
            borderWidth: 0
          }
        },
        series: [
          {
            name: 'Jumlah Madu',
            data: dataMadu
          }
        ],
        lang: {
          noData: "Tidak ada data untuk ditampilkan"
        },
        noData: {
          style: {
            fontWeight: 'bold',
            fontSize: '16px',
            color: '#303030'
          }
        }
      });
    });

    function confirmDelete(deleteUrl) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        window.location.href = deleteUrl;
      }
    }
  </script>
</body>

</html>
