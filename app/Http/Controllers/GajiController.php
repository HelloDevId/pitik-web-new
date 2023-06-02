<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::all();
        return view('admin.pages.datatenagakerja', [
            'gaji' => $gaji
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'jabatan' => 'required',
            'gaji' => 'required',
            'tanggal' => 'required',
        ], [
                'nama_karyawan.required' => 'Nama tidak boleh kosong',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'gaji.required' => 'Gaji tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
            ]);

        Gaji::create([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/datatenagakerja')->with('create', 'Data Berhasil Ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_karyawan' => 'required',
            'jabatan' => 'required',
            'gaji' => 'required',
            'tanggal' => 'required',
        ], [
                'nama_karyawan.required' => 'Nama tidak boleh kosong',
                'jabatan.required' => 'Jabatan tidak boleh kosong',
                'gaji.required' => 'Gaji tidak boleh kosong',
                'tanggal.required' => 'Tanggal tidak boleh kosong',
            ]);

        Gaji::where('id', $id)->update([
            'nama_karyawan' => $request->nama_karyawan,
            'jabatan' => $request->jabatan,
            'gaji' => $request->gaji,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/datatenagakerja')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        Gaji::find($id)->delete();
        return redirect('/datatenagakerja')->with('delete', 'Data Berhasil Dihapus');
    }
}