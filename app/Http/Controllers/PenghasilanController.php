<?php

namespace App\Http\Controllers;

use App\Models\PengeluaranAyam;
use App\Models\PengeluaranPakan;
use App\Models\PengeluaranGaji;
use App\Models\PengeluaranVaksin;
use App\Models\Penghasilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class PenghasilanController extends Controller
{
    public function index()
    {
        $datapenghasilan = Penghasilan::all();

        return view('admin.pages.datapenghasilan', [
            'datapenghasilan' => $datapenghasilan,
        ]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'pendapatan' => 'required',
            'pengeluaran_ayam' => 'required',
            'pengeluaran_pakan' => 'required',
            'pengeluaran_gaji' => 'required',
            'pengeluaran_vaksin' => 'required',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pengeluaran_ayam' => 'Pengeluaran Ayam harus diisi!',
                'pengeluaran_pakan' => 'Pengeluaran Pakan harus diisi!',
                'pengeluaran_gaji' => 'Pengeluaran Gaji harus diisi!',
                'pengeluaran_vaksin' => 'Pengeluaran Vaksin harus diisi!',
            ]);

        $penghasilan = $request->pendapatan - ($request->pengeluaran_ayam + $request->pengeluaran_pakan + $request->pengeluaran_gaji + $request->pengeluaran_vaksin);

        Penghasilan::create([
            'tanggal' => $request->tanggal,
            'pendapatan' => $request->pendapatan,
            'pengeluaran_ayam' => $request->pengeluaran_ayam,
            'pengeluaran_pakan' => $request->pengeluaran_pakan,
            'pengeluaran_gaji' => $request->pengeluaran_gaji,
            'pengeluaran_vaksin' => $request->pengeluaran_vaksin,
            'penghasilan' => $penghasilan,

        ]);

        return redirect('/datapenghasilan')->with('create', 'Data Penghasilan Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([

            'tanggal' => 'required',
            'pendapatan' => 'required',
            'pengeluaran_ayam' => 'required',
            'pengeluaran_pakan' => 'required',
            'pengeluaran_gaji' => 'required',
            'pengeluaran_vaksin' => 'required',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pengeluaran_ayam' => 'Pengeluaran Ayam harus diisi!',
                'pengeluaran_pakan' => 'Pengeluaran Pakan harus diisi!',
                'pengeluaran_gaji' => 'Pengeluaran Gaji harus diisi!',
                'pengeluaran_vaksin' => 'Pengeluaran Vaksin harus diisi!',
            ], [

            ]);

        $penghasilan = (($request->pendapatan) - ($request->pengeluaran_ayam + $request->pengeluaran_pakan + $request->pengeluaran_gaji + $request->pengeluaran_vaksin));
        Penghasilan::where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'pendapatan' => $request->pendapatan,
            'pengeluaran_ayam' => $request->pengeluaran_ayam,
            'pengeluaran_pakan' => $request->pengeluaran_pakan,
            'pengeluaran_gaji' => $request->pengeluaran_gaji,
            'pengeluaran_vaksin' => $request->pengeluaran_vaksin,
            'penghasilan' => $penghasilan,
        ]);

        return redirect('/datapenghasilan')->with('update', 'Data Penghasilan Berhasil Diubah!');

    }

    public function destroy($id)
    {
        Penghasilan::where('id', $id)->delete();
        return redirect('/datapenghasilan')->with('delete', 'Data Penghasilan Berhasil Dihapus!');
    }

}