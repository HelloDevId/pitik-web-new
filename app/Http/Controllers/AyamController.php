<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use App\Models\Distribusi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AyamController extends Controller
{
    public function index()
    {
        $ayam = Ayam::where('tanggal_masuk', '!=', null)->orderBy('tanggal_masuk', 'desc')->get();
        return view('admin.pages.dataayam', [
            'ayam' => $ayam
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'tanggal_masuk' => 'required|date|',
            'jumlah_masuk' => 'required|numeric|integer|gte:0',
            'harga_satuan' => 'required|numeric|integer|gte:0',
            'mati' => 'required|numeric|integer|gte:0|lte:jumlah_masuk',
        ], [
                // 'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                // 'tanggal_masuk.date' => 'Tanggal Masuk harus berupa tanggal',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'jumlah_masuk.numeric' => 'Jumlah Masuk harus berupa angka',
                'jumlah_masuk.integer' => 'Jumlah Masuk harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'mati.required' => 'Mati tidak boleh kosong',
                'mati.numeric' => 'Mati harus berupa angka',
                'mati.integer' => 'Mati harus berupa angka',
                'jumlah_masuk.gte' => 'Jumlah Masuk tidak boleh kurang dari 0',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 0',
                'mati.gte' => 'Mati tidak boleh kurang dari 0',
                'mati.lte' => 'Mati tidak boleh lebih dari Jumlah Masuk',
            ]);

        $cekpembelianayam = Ayam::whereMonth('tanggal_masuk', date('m'))->whereYear('tanggal_masuk', date('Y'))->first();
        if ($cekpembelianayam) {
            return redirect('/dataayam')->with('bulaninisudahada', 'Data Pembelian Ayam Bulan Ini Sudah Ada');
        }else{

            $totalayam = $request->jumlah_masuk - $request->mati;
            $totalharga = $request->harga_satuan * $request->jumlah_masuk;

            Ayam::create([
                'tanggal_masuk' => date('Y-m-d'),
                'jumlah_masuk' => $request->jumlah_masuk,
                'harga_satuan' => $request->harga_satuan,
                'total_harga' => $totalharga,
                'mati' => $request->mati,
                'total_ayam' => $totalayam
            ]);

            return redirect('/dataayam')->with('create', 'Data Berhasil Ditambahkan');
        }

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            // 'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric|integer|gte:0',
            'harga_satuan' => 'required|numeric|integer|gte:0',
            'mati' => 'required|numeric|integer|gte:0|lte:jumlah_masuk',
        ], [
                // 'tanggal_masuk.required' => 'Tanggal Masuk tidak boleh kosong',
                // 'tanggal_masuk.date' => 'Tanggal Masuk harus berupa tanggal',
                'jumlah_masuk.required' => 'Jumlah Masuk tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'mati.numeric' => 'Mati harus berupa angka',
                'mati.required' => 'Mati tidak boleh kosong',
                'mati.integer' => 'Mati harus berupa angka',
                'jumlah_masuk.numeric' => 'Jumlah Masuk harus berupa angka',
                'jumlah_masuk.integer' => 'Jumlah Masuk harus berupa angka',
                'jumlah_masuk.gte' => 'Jumlah Masuk tidak boleh kurang dari 0',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 0',
                'mati.gte' => 'Mati tidak boleh kurang dari 0',
                'mati.lte' => 'Mati tidak boleh lebih dari Jumlah Masuk',
            ]);

                $dataayam = Ayam::find($id);
                $totalayamlama = $dataayam->total_ayam;
                $jumlahmasuklama = $dataayam->jumlah_masuk;

                if($request->jumlah_masuk > $jumlahmasuklama){
                    $totalayam = $totalayamlama + ($request->jumlah_masuk - $jumlahmasuklama);
                    $totalayamakhir = $totalayam - $request->mati;
                }else{
                    $totalayam = $totalayamlama - ($jumlahmasuklama - $request->jumlah_masuk);
                    $totalayamakhir = $totalayam - $request->mati;
                }

                $totalharga = $request->harga_satuan * $request->jumlah_masuk;

                Ayam::find($id)->update([
                    // 'tanggal_masuk' => date('Y-m-d'),
                    'jumlah_masuk' => $request->jumlah_masuk,
                    'harga_satuan' => $request->harga_satuan,
                    'total_harga' => $totalharga,
                    'mati' => $request->mati,
                    'total_ayam' => $totalayamakhir
                ]);

                return redirect('/dataayam')->with('update', 'Data Berhasil Diubah');
        }


    public function destroy($id)
    {

        $cekdatadistributor = Distribusi::wheremonth('tanggal', date('m'))->whereyear('tanggal', date('Y'))->first();
        if ($cekdatadistributor) {
            return redirect('/dataayam')->with('punyarelasi', 'Data Distributor Bulan Ini Sudah Ada');
        }else{

            Ayam::find($id)->delete();
            return redirect('/dataayam')->with('delete', 'Data Berhasil Dihapus');
        }

    }
}
