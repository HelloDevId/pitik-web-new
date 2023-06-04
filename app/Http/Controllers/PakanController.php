<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::where('pembelian', '!=', null)->get();
        return view('admin.pages.datapakan', [
            'pakan' => $pakan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembelian' => 'required|date',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required|numeric|integer',
            'harga_kg' => 'required|numeric|integer',
        ], [
                'pembelian.required' => 'Tanggal Masuk tidak boleh kosong',
                'pembelian.date' => 'Tanggal Masuk harus berupa tanggal',
                'jenis_pakan.required' => 'Jumlah Masuk tidak boleh kosong',
                'jenis_pakan.string' => 'Jumlah Masuk harus berupa huruf',
                'stok_pakan.required' => 'Harga Satuan tidak boleh kosong',
                'stok_pakan.numeric' => 'Harga Satuan harus berupa angka',
                'stok_pakan.integer' => 'Harga Satuan harus berupa angka',
                'harga_kg.required' => 'Total Harga tidak boleh kosong',
                'harga_kg.numeric' => 'Total Harga harus berupa angka',
                'harga_kg.integer' => 'Total Harga harus berupa angka',
            ]);

        $totalharga = $request->harga_kg * $request->stok_pakan;

        Pakan::create([
            'pembelian' => $request->pembelian,
            'jenis_pakan' => $request->jenis_pakan,
            'stok_pakan' => $request->stok_pakan,
            'harga_kg' => $request->harga_kg,
            'total_harga' => $totalharga,
            'sisa_stok_pakan' => $request->stok_pakan,
        ]);

        return redirect('/datapakan')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembelian' => 'required|date',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required|numeric|integer',
            'harga_kg' => 'required|numeric|integer',
            'sisa_stok_pakan' => 'required|numeric|integer',

        ], [
                'pembelian.required' => 'Tanggal Masuk tidak boleh kosong',
                'pembelian.date' => 'Tanggal Masuk harus berupa tanggal',
                'jenis_pakan.required' => 'Jumlah Masuk tidak boleh kosong',
                'stok_pakan.required' => 'Harga Satuan tidak boleh kosong',
                'stok_pakan.numeric' => 'Harga Satuan harus berupa angka',
                'stok_pakan.integer' => 'Harga Satuan harus berupa angka',
                'harga_kg.required' => 'Total Harga tidak boleh kosong',
                'harga_kg.numeric' => 'Total Harga harus berupa angka',
                'harga_kg.integer' => 'Total Harga harus berupa angka',
                'sisa_stok_pakan.required' => 'Sisa Stok Pakan tidak boleh kosong',
                'sisa_stok_pakan.numeric' => 'Sisa Stok Pakan harus berupa angka',
                'sisa_stok_pakan.integer' => 'Sisa Stok Pakan harus berupa angka',

            ]);

        $totalharga = $request->harga_kg * $request->stok_pakan;

        Pakan::where('id', $id)->update([
            'pembelian' => $request->pembelian,
            'jenis_pakan' => $request->jenis_pakan,
            'stok_pakan' => $request->stok_pakan,
            'harga_kg' => $request->harga_kg,
            'total_harga' => $totalharga,
            'sisa_stok_pakan' => $request->sisa_stok_pakan,
        ]);

        return redirect('/datapakan')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Pakan::find($id)->delete();
        return redirect('/datapakan')->with('delete', 'Data Berhasil Dihapus');
    }

}