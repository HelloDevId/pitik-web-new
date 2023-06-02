<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Pendapatan;
use Illuminate\Http\Request;
use App\Models\DetailPendapatan;

class PendapatanController extends Controller
{
    public function index()
    {
        $pendapatan = Pendapatan::all();
        return view('admin.pages.datapendapatan', [
            'pendapatan' => $pendapatan
        ]);
    }

    public function detailpendapatan($id)
    {
        $pendapatan = Pendapatan::find($id);
        $tampildatadistribusi = Distribusi::all();
        $datapendapatan = DetailPendapatan::with('distribusi')->where('id_pendapatan', $id)->get();


        return view('admin.pages.datapendapatandetail', [
            'pendapatan' => $pendapatan,
            'datapendapatan' => $datapendapatan,
            'tampildatadistribusi' => $tampildatadistribusi
        ]);
    }

    public function addiddistribusi(Request $request)
    {
        $request->validate([
            'id_distribusi' => 'required',
        ], [
                'id_distribusi.required' => 'Distribusi harus diisi',
            ]);

        $cekiddistribusi = DetailPendapatan::where('id_distribusi', $request->id_distribusi)->first();
        if ($cekiddistribusi) {
            return redirect()->back()->with('sudahada', 'Data Distribusi Sudah Ada!');
        } else {

            $detailpendapatan = new DetailPendapatan;
            $detailpendapatan->id_pendapatan = $request->id_pendapatan;
            $detailpendapatan->id_distribusi = $request->id_distribusi;
            $detailpendapatan->save();
        }

        return redirect('/datapendapatan/' . $request->id_pendapatan)->with('create', 'Data Ayam Berhasil Ditambahkan!');
    }

    public function deleteiddistribusi($id)
    {
        DetailPendapatan::where('id_distribusi', $id)->delete();

        return redirect()->back()->with('delete', 'Data Ayam Berhasil Dihapus!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pendapatan = new Pendapatan;
        $pendapatan->tanggal = $request->tanggal;
        $pendapatan->save();

        return redirect('/datapendapatan')->with('create', 'Data berhasil ditambahkan');

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ], [
                'tanggal.required' => 'Tanggal harus diisi',
            ]);

        $pendapatan = Pendapatan::find($id);
        $pendapatan->tanggal = $request->tanggal;
        $pendapatan->save();

        return redirect('/datapendapatan')->with('update', 'Data berhasil diupdate');

    }

    public function destroy($id)
    {
        $pendapatan = Pendapatan::find($id);
        $pendapatan->delete();

        return redirect('/datapendapatan')->with('delete', 'Data berhasil dihapus');
    }

}