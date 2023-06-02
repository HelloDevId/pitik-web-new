<?php

namespace App\Http\Controllers;

use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakan = Pakan::all();
        return view('admin.pages.datapakan', [
            'pakan' => $pakan
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pembelian' => 'required',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required',
            'harga_kg' => 'required',
        ], [
                'pembelian.required' => 'Tanggal Masuk tidak boleh kosong',
                'jenis_pakan.required' => 'Jumlah Masuk tidak boleh kosong',
                'stok_pakan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_kg.required' => 'Total Harga tidak boleh kosong',
            ]);

        $totalharga = $request->harga_kg * $request->stok_pakan;

        Pakan::create([
            'pembelian' => $request->pembelian,
            'jenis_pakan' => $request->jenis_pakan,
            'stok_pakan' => $request->stok_pakan,
            'harga_kg' => $request->harga_kg,
            'total_harga' => $totalharga
        ]);

        return redirect('/datapakan')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pembelian' => 'required',
            'jenis_pakan' => 'required',
            'stok_pakan' => 'required',
            'harga_kg' => 'required',

        ], [
                'pembelian.required' => 'Tanggal Masuk tidak boleh kosong',
                'jenis_pakan.required' => 'Jumlah Masuk tidak boleh kosong',
                'stok_pakan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_kg.required' => 'Total Harga tidak boleh kosong',

            ]);

        $totalharga = $request->harga_kg * $request->stok_pakan;

        Pakan::where('id', $id)->update([
            'pembelian' => $request->pembelian,
            'jenis_pakan' => $request->jenis_pakan,
            'stok_pakan' => $request->stok_pakan,
            'harga_kg' => $request->harga_kg,
            'total_harga' => $totalharga
        ]);

        return redirect('/datapakan')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Pakan::find($id)->delete();
        return redirect('/datapakan')->with('delete', 'Data Berhasil Dihapus');
    }

}