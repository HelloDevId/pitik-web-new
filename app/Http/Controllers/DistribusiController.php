<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribusi;

class DistribusiController extends Controller
{
    public function index()
    {
        $distribusi = Distribusi::where('tanggal', '!=', null)->orderBy('tanggal', 'desc')->get();
        return view('admin.pages.datadistribusi', [
            'distribusi' => $distribusi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required|string',
            'tanggal' => 'required|date',
            'total_ayam' => 'required|numeric|integer|gte:0',
            'harga_satuan' => 'required|numeric|integer|gte:0',
            'contact' => 'required|numeric|min:11',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'customer.string' => 'Customer harus berupa huruf',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tanggal.date' => 'Tanggal harus berupa tanggal',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'total_ayam.numeric' => 'Total Ayam harus berupa angka',
                'total_ayam.integer' => 'Total Ayam harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'contact.required' => 'Contact tidak boleh kosong',
                'contact.numeric' => 'Contact harus berupa angka',
                'contact.min' => 'Contact minimal 11 angka',
                'total_ayam.gte' => 'Total Ayam tidak boleh kurang dari 0',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 0',

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
            'customer' => 'required|string',
            'tanggal' => 'required|date',
            'total_ayam' => 'required|numeric|integer|gte:0',
            'harga_satuan' => 'required|numeric|integer|gte:0',
            'contact' => 'required|numeric|min:11',
        ], [
                'customer.required' => 'Customer tidak boleh kosong',
                'customer.string' => 'Customer harus berupa huruf',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
                'tanggal.date' => 'Tanggal harus berupa tanggal',
                'total_ayam.required' => 'Total Ayam tidak boleh kosong',
                'harga_satuan.numeric' => 'Harga Satuan harus berupa angka',
                'harga_satuan.integer' => 'Harga Satuan harus berupa angka',
                'harga_satuan.required' => 'Harga Satuan tidak boleh kosong',
                'contact.numeric' => 'Contact harus berupa angka',
                'contact.required' => 'Contact tidak boleh kosong',
                'contact.min' => 'Contact minimal 11 angka',
                'total_ayam.gte' => 'Total Ayam tidak boleh kurang dari 0',
                'harga_satuan.gte' => 'Harga Satuan tidak boleh kurang dari 0',
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