<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use Illuminate\Http\Request;

class AyamController extends Controller
{
    public function index()
    {
        $ayam = Ayam::all();
        return view('admin.pages.dataayam', [
            'ayam' => $ayam
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required',
        ], [
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'mati.required' => 'Mati tidak boleh kosong',
            ]);

        $totalayam = $request->jumlah_masuk - $request->mati;
        $totalharga = $request->harga_satuan * $totalayam;

        Ayam::create([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $totalharga,
            'mati' => $request->mati,
            'total_ayam' => $totalayam
        ]);

        return redirect('/dataayam')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_masuk' => 'required',
            'jumlah_masuk' => 'required',
            'harga_satuan' => 'required',
            'mati' => 'required',
        ], [
                'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'mati.required' => 'Mati tidak boleh kosong',
            ]);

        $totalayam = $request->jumlah_masuk - $request->mati;
        $totalharga = $request->harga_satuan * $totalayam;

        Ayam::where('id', $id)->update([
            'tanggal_masuk' => $request->tanggal_masuk,
            'jumlah_masuk' => $request->jumlah_masuk,
            'harga_satuan' => $request->harga_satuan,
            'total_harga' => $totalharga,
            'mati' => $request->mati,
            'total_ayam' => $totalayam
        ]);

        return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');

    }

    public function destroy($id)
    {
        Ayam::find($id)->delete();
        return redirect('/dataayam')->with('delete', 'Data Berhasil Dihapus');
    }
}