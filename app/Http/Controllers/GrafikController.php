<?php

namespace App\Http\Controllers;

use App\Models\DataLebah;
use App\Models\Panen;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    // Menampilkan halaman utama monitoring lebah
    public function index()
    {
        $dataLebah = DataLebah::all(); // Mengambil semua data lebah

        // Ambil data panen per bulan
        $dataPanen = Panen::selectRaw('MONTH(tanggal_panen) as bulan, SUM(jumlah_madu) as total_madu')
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $grafikData = array_fill(0, 12, 0); // Inisialisasi data bulan kosong

        foreach ($dataPanen as $item) {
            $grafikData[$item->bulan - 1] = $item->total_madu; // Memasukkan data madu berdasarkan bulan
        }

        return view('grafik', [
            'datalebah' => $dataLebah,
            'data' => Panen::all(), // Mengirimkan semua data panen ke view
            'grafikData' => $grafikData // Data grafik berdasarkan bulan
        ]);
    }

    // Menambahkan data panen
    public function tambahDataPanen(Request $request)
    {
        $request->validate([
            'jenis_lebah' => 'required|exists:data_lebah,jenis_lebah',
            'tanggal_panen' => 'required|date',
            'jumlah_madu' => 'required|integer',
        ]);

        Panen::create([
            'jenis_lebah' => $request->jenis_lebah,
            'tanggal_panen' => $request->tanggal_panen,
            'jumlah_madu' => $request->jumlah_madu,
        ]);

        return redirect('/')->with('success', 'Data panen berhasil ditambahkan!');
    }

    // Menampilkan data panen untuk edit
    public function tampilDataPanen($id)
    {
        $panen = Panen::findOrFail($id);
        $datalebah = DataLebah::all();

        return view('edit-panen', compact('panen', 'datalebah'));
    }

    // Mengubah data panen
    public function ubahDataPanen(Request $request, $id)
    {
        $request->validate([
            'jenis_lebah' => 'required|exists:data_lebah,jenis_lebah',
            'tanggal_panen' => 'required|date',
            'jumlah_madu' => 'required|integer',
        ]);

        $panen = Panen::findOrFail($id);
        $panen->update([
            'jenis_lebah' => $request->jenis_lebah,
            'tanggal_panen' => $request->tanggal_panen,
            'jumlah_madu' => $request->jumlah_madu,
        ]);

        return redirect('/')->with('success', 'Data panen berhasil diubah!');
    }

    // Menghapus data panen
    public function hapusDataPanen($id)
    {
        $panen = Panen::findOrFail($id);
        $panen->delete();

        return redirect('/')->with('success', 'Data panen berhasil dihapus!');
    }
}
