<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaksin;

class VaksinController extends Controller
{
    public function index()
    {
        $vaksin = Vaksin::where('tanggal_ovk', '!=', null)->get();
        return view('admin.pages.dataovk', [
            'vaksin' => $vaksin
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_ovk' => 'required',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required',
            'next_ovk' => 'required',
            'biaya_ovk' => 'required',
        ], [
                'tanggal_ovk.required' => 'Tanggal tidak boleh kosong',
                'jenis_ovk.required' => 'Jenis Vaksin tidak boleh kosong',
                'jumlah_ayam.required' => 'Jumlah Vaksin tidak boleh kosong',
                'next_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'biaya_ovk.required' => 'Harga Satuan tidak boleh kosong',
            ]);

        $totalbiaya = $request->biaya_ovk * $request->jumlah_ayam;

        Vaksin::create([
            'tanggal_ovk' => $request->tanggal_ovk,
            'jenis_ovk' => $request->jenis_ovk,
            'jumlah_ayam' => $request->jumlah_ayam,
            'next_ovk' => $request->next_ovk,
            'biaya_ovk' => $request->biaya_ovk,
            'total_biaya' => $totalbiaya
        ]);

        return redirect('/dataovk')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_ovk' => 'required',
            'jenis_ovk' => 'required',
            'jumlah_ayam' => 'required',
            'next_ovk' => 'required',
            'biaya_ovk' => 'required',
        ], [
                'tanggal_ovk.required' => 'Tanggal tidak boleh kosong',
                'jenis_ovk.required' => 'Jenis Vaksin tidak boleh kosong',
                'jumlah_ayam.required' => 'Jumlah Vaksin tidak boleh kosong',
                'next_ovk.required' => 'Harga Satuan tidak boleh kosong',
                'biaya_ovk.required' => 'Harga Satuan tidak boleh kosong',
            ]);

        $totalbiaya = $request->biaya_ovk * $request->jumlah_ayam;

        Vaksin::find($id)->update([
            'tanggal_ovk' => $request->tanggal_ovk,
            'jenis_ovk' => $request->jenis_ovk,
            'jumlah_ayam' => $request->jumlah_ayam,
            'next_ovk' => $request->next_ovk,
            'biaya_ovk' => $request->biaya_ovk,
            'total_biaya' => $totalbiaya
        ]);

        return redirect('/dataovk')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Vaksin::find($id)->delete();
        return redirect('/dataovk')->with('delete', 'Data Berhasil Dihapus');
    }
}