<?php

namespace App\Http\Controllers;

use App\Models\DataLebah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataLebahController extends Controller
{
    public function index()
    {
        $data = DataLebah::all();
        return view('dataLebah', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function insert(Request $request)
    {
        //dd($request->all());
        $validated = $request->validate([
            'jenis_lebah' => 'required|string|max:255',
            'tanggal_pengadaan' => 'required|date',
            'kondisiLebah' => 'nullable|string',
            'kondisiCuaca' => 'nullable|string',
            'catatanPanen' => 'nullable|string',
            'hargaJual' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = new DataLebah();
        $data->jenis_lebah = $validated['jenis_lebah'];
        $data->tanggal_pengadaan = $validated['tanggal_pengadaan'];

        $data->catatan_kesehatan = json_encode(array_filter([
            'kondisiLebah' => $validated['kondisiLebah'] ?? null,
            'kondisiCuaca' => $validated['kondisiCuaca'] ?? null,
        ]));

        $data->catatan_panen = json_encode(array_filter([
            'catatanPanen' => $validated['catatanPanen'] ?? null,
            'hargaJual' => $validated['hargaJual'] ?? null,
        ]));

        if ($request->hasFile('gambar')) {
            $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar', $fileName, 'public');
            $data->gambar = $fileName;
        }

        $data->save();

        return redirect()->route('datalebah')->with('success', 'Data Berhasil Ditambahkan');
    }


    public function tampildata($id)
    {
        $data = DataLebah::find($id);
        if (!$data) {
            return redirect()->route('datalebah')->with('error', 'Data Tidak Ditemukan');
        }
        return view('show', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = DataLebah::find($id);

        $validated = $request->validate([
            'jenis_lebah' => 'required|string|max:255',
            'tanggal_pengadaan' => 'required|date',
            'kondisiLebah' => 'nullable|string',
            'kondisiCuaca' => 'nullable|string',
            'catatanPanen' => 'nullable|string',
            'hargaJual' => 'nullable|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data->jenis_lebah = $validated['jenis_lebah'];
        $data->tanggal_pengadaan = $validated['tanggal_pengadaan'];

        $data->catatan_kesehatan = json_encode(array_filter([
            'kondisiLebah' => $validated['kondisiLebah'] ?? null,
            'kondisiCuaca' => $validated['kondisiCuaca'] ?? null,
        ]));

        $data->catatan_panen = json_encode(array_filter([
            'catatanPanen' => $validated['catatanPanen'] ?? null,
            'hargaJual' => $validated['hargaJual'] ?? null,
        ]));

        if ($request->hasFile('gambar')) {
            if ($data->gambar && Storage::exists('public/gambar/' . $data->gambar)) {
                Storage::delete('public/gambar/' . $data->gambar);
            }

            $fileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('gambar', $fileName, 'public');
            $data->gambar = $fileName;
        }

        $data->save();

        return redirect()->route('datalebah')->with('success', 'Data Berhasil Diperbarui');
    }


    public function delete($id)
    {
        $data = DataLebah::find($id);

        if (!$data) {
            return redirect()->route('datalebah')->with('error', 'Data Tidak Ditemukan');
        }

        // Hapus gambar jika ada
        if ($data->gambar && Storage::exists('public/gambar/' . $data->gambar)) {
            Storage::delete('public/gambar/' . $data->gambar);
        }

        $data->delete();

        return redirect()->route('datalebah')->with('success', 'Data Berhasil Dihapus');
    }

    public function read($id)
    {
        $data = DataLebah::find($id);
        if (!$data) {
            return redirect()->route('datalebah')->with('error', 'Data Tidak Ditemukan');
        }
        return view('tampilkan', compact('data'));
    }
}
