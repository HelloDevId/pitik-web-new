<?php

namespace App\Http\Controllers;

use App\Models\Ayam;
use App\Models\Gaji;
use App\Models\Pakan;
use App\Models\Vaksin;
use App\Models\DetailAyam;
use App\Models\DetailGaji;
use App\Models\DetailPakan;
use App\Models\Pengeluaran;
use App\Models\DetailVaksin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengeluaranController extends Controller
{
    public function index()
    {
        // $pengeluaran = Pengeluaran::all();

        $totalpengeluaran = DB::table('tb_pengeluaran')
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

        return view('admin.pages.datapengeluaran', [
            'totalpengeluaran' => $totalpengeluaran,
            // 'pengeluaran' => $pengeluaran
        ]);
    }

    public function detailpengeluaran($id)
    {
        $tampildataayam = Ayam::where('id', '!=', 1)->get();
        $tampildatapakan = Pakan::where('id', '!=', 1)->get();
        $tampildatavaksin = Vaksin::where('id', '!=', 1)->get();
        $tampildatagaji = Gaji::where('id', '!=', 1)->get();

        $datapakan = DetailPakan::with('pakan')->where('id_pengeluaran', $id)->where('id_pakan', '!=', 1)->get();
        $datavaksin = DetailVaksin::with('vaksin')->where('id_pengeluaran', $id)->where('id_vaksin', '!=', 1)->get();
        $dataayam = DetailAyam::with('ayam')->where('id_pengeluaran', $id)->where('id_ayam', '!=', 1)->get();
        $datagaji = DetailGaji::with('gaji')->where('id_pengeluaran', $id)->where('id_gaji', '!=', 1)->get();

        $pengeluaran = Pengeluaran::find($id);
        return view('admin.pages.datapengeluarandetail', [
            'pengeluaran' => $pengeluaran,
            'datapakan' => $datapakan,
            'datavaksin' => $datavaksin,
            'dataayam' => $dataayam,
            'datagaji' => $datagaji,
            'tampildataayam' => $tampildataayam,
            'tampildatapakan' => $tampildatapakan,
            'tampildatavaksin' => $tampildatavaksin,
            'tampildatagaji' => $tampildatagaji,
        ]);
    }


    ###############################

    public function addidayam(Request $request)
    {
        $request->validate([
            'id_pengeluaran' => 'required',
            'id_ayam' => 'required',
        ]);

        $cekidayam = DetailAyam::where('id_pengeluaran', $request->id_pengeluaran)->where('id_ayam', $request->id_ayam)->first();
        if ($cekidayam) {
            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('sudahada', 'Data Ayam Sudah Ada!');
        } else {

            DetailAyam::create([
                'id_pengeluaran' => $request->id_pengeluaran,
                'id_ayam' => $request->id_ayam,
            ]);

            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('create', 'Data Ayam Berhasil Ditambahkan!');
        }
    }

    // public function updateidayam(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_ayam' => 'required',
    //     ]);

    //     DetailAyam::where('id_ayam', $id)
    //         ->update([
    //             'id_ayam' => $request->id_ayam,
    //         ]);
    //     return redirect()->back()->with('update', 'Data Ayam Berhasil Diubah!');
    // }

    public function deleteidayam($id)
    {
        DetailAyam::where('id_ayam', $id)->delete();
        return redirect()->back()->with('delete', 'Data Ayam Berhasil Dihapus!');
    }

    ######################################################

    public function addidpakan(Request $request)
    {
        $request->validate([
            'id_pengeluaran' => 'required',
            'id_pakan' => 'required',
        ]);

        $cekidpakan = DetailPakan::where('id_pengeluaran', $request->id_pengeluaran)->where('id_pakan', $request->id_pakan)->first();
        if ($cekidpakan) {
            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('sudahada', 'Data Pakan Sudah Ada!');
        } else {

            DetailPakan::create([
                'id_pengeluaran' => $request->id_pengeluaran,
                'id_pakan' => $request->id_pakan,
            ]);

            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('create', 'Data Pakan Berhasil Ditambahkan!');
        }
    }

    // public function updateidpakan(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_pakan' => 'required',
    //     ]);

    //     DetailPakan::where('id_pakan', $id)
    //         ->update([
    //             'id_pakan' => $request->id_pakan,
    //         ]);
    //     return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('update', 'Data Pakan Berhasil Diubah!');
    // }

    public function deleteidpakan(Request $request, $id)
    {
        DetailPakan::where('id_pakan', $id)->delete();
        return redirect()->back()->with('delete', 'Data Pakan Berhasil Dihapus!');
    }

    ########################################################

    public function addidvaksin(Request $request)
    {
        $request->validate([
            'id_pengeluaran' => 'required',
            'id_vaksin' => 'required',
        ]);

        $cekidvaksin = DetailVaksin::where('id_pengeluaran', $request->id_pengeluaran)->where('id_vaksin', $request->id_vaksin)->first();
        if ($cekidvaksin) {
            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('sudahada', 'Data Vaksin Sudah Ada!');
        } else {

            DetailVaksin::create([
                'id_pengeluaran' => $request->id_pengeluaran,
                'id_vaksin' => $request->id_vaksin,
            ]);

            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('create', 'Data Vaksin Berhasil Ditambahkan!');
        }
    }

    // public function updateidvaksin(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_vaksin' => 'required',
    //     ]);

    //     DetailVaksin::where('id', $id)
    //         ->update([
    //             'id_vaksin' => $request->id_vaksin,
    //         ]);
    //     return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('update', 'Data Vaksin Berhasil Diubah!');
    // }

    public function deleteidvaksin(Request $request, $id)
    {
        DetailVaksin::where('id_vaksin', $id)->delete();
        return redirect()->back()->with('delete', 'Data Vaksin Berhasil Dihapus!');
    }

    #######################################################

    public function addidgaji(Request $request)
    {
        $request->validate([
            'id_pengeluaran' => 'required',
            'id_gaji' => 'required',
        ]);

        $cekidgaji = DetailGaji::where('id_pengeluaran', $request->id_pengeluaran)->where('id_gaji', $request->id_gaji)->first();
        if ($cekidgaji) {
            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('sudahada', 'Data Gaji Sudah Ada!');
        } else {

            DetailGaji::create([
                'id_pengeluaran' => $request->id_pengeluaran,
                'id_gaji' => $request->id_gaji,
            ]);

            return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('create', 'Data Gaji Berhasil Ditambahkan!');
        }
    }

    // public function updateidgaji(Request $request, $id)
    // {
    //     $request->validate([
    //         'id_gaji' => 'required',
    //     ]);

    //     DetailGaji::where('id', $id)
    //         ->update([
    //             'id_gaji' => $request->id_gaji,
    //         ]);
    //     return redirect('/datapengeluaran/' . $request->id_pengeluaran)->with('update', 'Data Gaji Berhasil Diubah!');
    // }

    public function deleteidgaji(Request $request, $id)
    {
        DetailGaji::where('id_gaji', $id)->delete();
        return redirect()->back()->with('delete', 'Data Gaji Berhasil Dihapus!');
    }

    #################################################

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
        ]);

        Pengeluaran::create([
            'tanggal' => $request->tanggal,
        ]);

        // $cekidpengeluaran = Pengeluaran::all()->last();
        // $id_pengeluaran = $cekidpengeluaran->id;

        $dataayam = Ayam::find(1);
        $datapakan = Pakan::find(1);
        $datavaksin = Vaksin::find(1);
        $datagaji = Gaji::find(1);

        $cekidpengeluaran = Pengeluaran::all()->last();

        DetailAyam::create([
            'id_pengeluaran' => $cekidpengeluaran->id,
            'id_ayam' => $dataayam->id,
        ]);

        DetailPakan::create([
            'id_pengeluaran' => $cekidpengeluaran->id,
            'id_pakan' => $datapakan->id,
        ]);

        DetailVaksin::create([
            'id_pengeluaran' => $cekidpengeluaran->id,
            'id_vaksin' => $datavaksin->id,
        ]);

        DetailGaji::create([
            'id_pengeluaran' => $cekidpengeluaran->id,
            'id_gaji' => $datagaji->id,
        ]);


        return redirect('/datapengeluaran/')->with('create', 'Data Pengeluaran Berhasil Ditambahkan!');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required',
        ]);

        Pengeluaran::where('id', $id)
            ->update([
                'tanggal' => $request->tanggal,
            ]);
        return redirect('/datapengeluaran')->with('update', 'Data Pengeluaran Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $cekdetailayam = DetailAyam::where('id_pengeluaran', $id)->first();
        $cekdetailpakan = DetailPakan::where('id_pengeluaran', $id)->first();
        $cekdetailvaksin = DetailVaksin::where('id_pengeluaran', $id)->first();
        $cekdetailgaji = DetailGaji::where('id_pengeluaran', $id)->first();

        if ($cekdetailayam) {
            DetailAyam::where('id_pengeluaran', $id)->delete();
        }

        if ($cekdetailpakan) {
            DetailPakan::where('id_pengeluaran', $id)->delete();
        }

        if ($cekdetailvaksin) {
            DetailVaksin::where('id_pengeluaran', $id)->delete();
        }

        if ($cekdetailgaji) {
            DetailGaji::where('id_pengeluaran', $id)->delete();
        }

        Pengeluaran::find($id)->delete();
        return redirect('/datapengeluaran')->with('delete', 'Data Pengeluaran Berhasil Dihapus!');
    }
}