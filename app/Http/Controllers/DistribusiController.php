<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusi = Distribusi::where('tanggal', '!=', null)->get();
        return view('admin.pages.datadistribusi', [
            'distribusi' => $distribusi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'tanggal' => 'required',
            'total_ayam' => 'required',
            'harga_satuan' => 'required',
            'contact' => 'required',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'contact.required' => 'Contact tidak boleh kosong',
            ]);

        $totalharga = $request->harga_satuan * $request->total_ayam;

        Distribusi::create([
            'customer' => $request->customer,
            'tanggal' => $request->tanggal,
            'total_ayam' => $request->total_ayam,
            'harga_satuan' => $request->harga_satuan,
            'payment' => $totalharga,
            'contact' => $request->contact,
        ]);

        return redirect('/datadistribusi')->with('create', 'Data Berhasil Diubah');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'customer' => 'required',
            'tanggal' => 'required',
            'total_ayam' => 'required',
            'harga_satuan' => 'required',
            'contact' => 'required',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'contact.required' => 'Contact tidak boleh kosong',
            ]);

        $totalharga = $request->harga_satuan * $request->total_ayam;

        Distribusi::where('id', $id)->update([
            'customer' => $request->customer,
            'tanggal' => $request->tanggal,
            'total_ayam' => $request->total_ayam,
            'harga_satuan' => $request->harga_satuan,
            'payment' => $totalharga,
            'contact' => $request->contact,
        ]);

        return redirect('/datadistribusi')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Distribusi::where('id', $id)->delete();
        return redirect('/datadistribusi')->with('delete', 'Data Berhasil Dihapus');
    }

}