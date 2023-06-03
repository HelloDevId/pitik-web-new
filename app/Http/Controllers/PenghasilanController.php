<?php

namespace App\Http\Controllers;

use App\Models\Penghasilan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;

class PenghasilanController extends Controller
{
    public function index()
    {
        $tampildatapengeluaran = DB::table('tb_pengeluaran')
            ->join('tb_detail_pengeluaran_ayam', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_ayam.id_pengeluaran')
            ->join('tb_ayam', 'tb_detail_pengeluaran_ayam.id_ayam', '=', 'tb_ayam.id')
            ->join('tb_detail_pengeluaran_pakan', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_pakan.id_pengeluaran')
            ->join('tb_pakan', 'tb_detail_pengeluaran_pakan.id_pakan', '=', 'tb_pakan.id')
            ->join('tb_detail_pengeluaran_vaksin', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_vaksin.id_pengeluaran')
            ->join('tb_vaksin', 'tb_detail_pengeluaran_vaksin.id_vaksin', '=', 'tb_vaksin.id')
            ->join('tb_detail_pengeluaran_gaji', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_gaji.id_pengeluaran')
            ->join('tb_gaji', 'tb_detail_pengeluaran_gaji.id_gaji', '=', 'tb_gaji.id')
            ->select('tb_pengeluaran.*', DB::raw('SUM(tb_ayam.total_harga) as total_ayam'), DB::raw('SUM(tb_pakan.total_harga) as total_pakan'), DB::raw('SUM(tb_vaksin.total_biaya) as total_vaksin'), DB::raw('SUM(tb_gaji.gaji) as total_gaji'))
            ->groupBy('tb_pengeluaran.id')->get();

        $tampildatapenghasilan = DB::table('tb_pendapatan')
            ->join('tb_detail_pendapatan', 'tb_pendapatan.id', '=', 'tb_detail_pendapatan.id_pendapatan')
            ->join('tb_distribusi', 'tb_detail_pendapatan.id_distribusi', '=', 'tb_distribusi.id')
            ->select('tb_pendapatan.*', DB::raw('SUM(tb_distribusi.payment) as total'))
            ->groupBy('tb_pendapatan.id')
            ->get();


        $totaljumlahpenghasilan =

            DB::table('tb_penghasilan')
                ->join('tb_pendapatan', 'tb_penghasilan.id_pendapatan', '=', 'tb_pendapatan.id')
                ->join('tb_detail_pendapatan', 'tb_pendapatan.id', '=', 'tb_detail_pendapatan.id_pendapatan')
                ->join('tb_distribusi', 'tb_detail_pendapatan.id_distribusi', '=', 'tb_distribusi.id')


                ->join('tb_pengeluaran', 'tb_penghasilan.id_pengeluaran', '=', 'tb_pengeluaran.id')

                ->join('tb_detail_pengeluaran_ayam', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_ayam.id_pengeluaran')
                ->join('tb_ayam', 'tb_detail_pengeluaran_ayam.id_ayam', '=', 'tb_ayam.id')


                ->join('tb_detail_pengeluaran_pakan', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_pakan.id_pengeluaran')
                ->join('tb_pakan', 'tb_detail_pengeluaran_pakan.id_pakan', '=', 'tb_pakan.id')


                ->join('tb_detail_pengeluaran_vaksin', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_vaksin.id_pengeluaran')
                ->join('tb_vaksin', 'tb_detail_pengeluaran_vaksin.id_vaksin', '=', 'tb_vaksin.id')


                ->join('tb_detail_pengeluaran_gaji', 'tb_pengeluaran.id', '=', 'tb_detail_pengeluaran_gaji.id_pengeluaran')
                ->join('tb_gaji', 'tb_detail_pengeluaran_gaji.id_gaji', '=', 'tb_gaji.id')


                ->select('tb_penghasilan.*', DB::raw('SUM(tb_distribusi.payment) as total'), DB::raw('SUM(tb_ayam.total_harga) as total_ayam'), DB::raw('SUM(tb_pakan.total_harga) as total_pakan'), DB::raw('SUM(tb_vaksin.total_biaya) as total_vaksin'), DB::raw('SUM(tb_gaji.gaji) as total_gaji'))
                ->groupBy('tb_penghasilan.id', 'tb_pendapatan.id', 'tb_pengeluaran.id', )
                ->get();


        return view('admin.pages.datapenghasilan', [
            // 'penghasilan' => $penghasilan,
            'tampildatapengeluaran' => $tampildatapengeluaran,
            'tampildatapenghasilan' => $tampildatapenghasilan,
            'totaljumlahpenghasilan' => $totaljumlahpenghasilan,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_pengeluaran' => 'required|unique:tb_penghasilan,id_pengeluaran',
            'id_pendapatan' => 'required|unique:tb_penghasilan,id_pendapatan',
        ], [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'id_pengeluaran.required' => 'Pengeluaran tidak boleh kosong!',
                'id_pendapatan.required' => 'Pendapatan tidak boleh kosong!',
                'id_pengeluaran.unique' => 'Pengeluaran sudah terdaftar!',
                'id_pendapatan.unique' => 'Pendapatan sudah terdaftar!',
            ]);

        Penghasilan::create([
            'tanggal' => $request->tanggal,
            'id_pengeluaran' => $request->id_pengeluaran,
            'id_pendapatan' => $request->id_pendapatan,
        ]);

        return redirect('/datapenghasilan')->with('create', 'Data Penghasilan Berhasil Ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'id_pengeluaran' => 'required|unique:tb_penghasilan,id_pengeluaran, ' . $id,
            'id_pendapatan' => 'required|unique:tb_penghasilan,id_pendapatan, ' . $id,
        ], [
                'tanggal.required' => 'Tanggal tidak boleh kosong!',
                'id_pengeluaran.required' => 'Pengeluaran tidak boleh kosong!',
                'id_pendapatan.required' => 'Pendapatan tidak boleh kosong!',
                'id_pengeluaran.unique' => 'Pengeluaran sudah terdaftar!',
                'id_pendapatan.unique' => 'Pendapatan sudah terdaftar!',
            ]);

        Penghasilan::where('id', $id)->update([
            'tanggal' => $request->tanggal,
            'id_pengeluaran' => $request->id_pengeluaran,
            'id_pendapatan' => $request->id_pendapatan,
        ]);

        return redirect('/datapenghasilan')->with('update', 'Data Penghasilan Berhasil Diubah!');

    }

    public function destroy($id)
    {
        Penghasilan::where('id', $id)->delete();
        return redirect('/datapenghasilan')->with('delete', 'Data Penghasilan Berhasil Dihapus!');
    }

}