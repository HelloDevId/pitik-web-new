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
            'tanggal' => 'required|date',
            'pendapatan' => 'required|numeric|integer',
            'pengeluaran_ayam' => 'required|numeric|integer',
            'pengeluaran_pakan' => 'required|numeric|integer',
            'pengeluaran_gaji' => 'required|numeric|integer',
            'pengeluaran_vaksin' => 'required|numeric|integer',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'tanggal.date' => 'Tanggal harus berupa tanggal!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pendapatan.numeric' => 'Pendapatan harus berupa angka!',
                'pendapatan.integer' => 'Pendapatan harus berupa angka!',
                'pengeluaran_ayam' => 'Pengeluaran Ayam harus diisi!',
                'pengeleuran_ayam.numeric' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_ayam.integer' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan' => 'Pengeluaran Pakan harus diisi!',
                'pengeluaran_pakan.numeric' => 'Pengeluaran Pakan harus berupa angka!',
                'pengeluaran_pakan.integer' => 'Pengeluaran Pakan harus berupa angka!',
                'pengeluaran_gaji' => 'Pengeluaran Gaji harus diisi!',
                'pengeluaran_gaji.numeric' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_gaji.integer' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_vaksin' => 'Pengeluaran Vaksin harus diisi!',
                'pengeluaran_vaksin.numeric' => 'Pengeluaran Vaksin harus berupa angka!',
                'pengeluaran_vaksin.integer' => 'Pengeluaran Vaksin harus berupa angka!',
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

            'tanggal' => 'required|date',
            'pendapatan' => 'required|numeric|integer',
            'pengeluaran_ayam' => 'required|numeric|integer',
            'pengeluaran_pakan' => 'required|numeric|integer',
            'pengeluaran_gaji' => 'required|numeric|integer',
            'pengeluaran_vaksin' => 'required|numeric|integer',

        ], [
                'tanggal' => 'Tanggal harus diisi!',
                'pendapatan.numeric' => 'Pendapatan harus berupa angka!',
                'pendapatan' => 'Pendapatan harus diisi!',
                'pengeluaran_ayam.numeric' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan.numeric' => 'Pengeluaran Pakan harus berupa angka!',
                'pengeluaran_gaji.numeric' => 'Pengeluaran Gaji harus berupa angka!',
                'pengeluaran_vaksin.numeric' => 'Pengeluaran Vaksin harus berupa angka!',
                'pendapatan.integer' => 'Pendapatan harus berupa angka!',
                'pengeluaran_ayam.integer' => 'Pengeluaran Ayam harus berupa angka!',
                'pengeluaran_pakan.integer' => 'Pengeluaran Pakan harus berupa angka!',
                'pengeluaran_gaji.integer' => 'Pengeluaran Gaji harus berupa angka!',
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