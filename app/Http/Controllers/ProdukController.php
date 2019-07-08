<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProdukController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function getProduk()
    {
        $pidd_payment_type = DB::table('pos_konf')
            ->where('var', 'pidd_payment_type')
            ->first();
        $en_id = DB::table('pos_konf')
            ->where('var', 'pi_id')
            ->first();
        $getbarang = DB::table('pi_mstr')
            ->join('pid_det', 'pi_mstr.pi_oid', '=', 'pid_det.pid_pi_oid')
            ->join('pidd_det', 'pid_det.pid_oid', '=', 'pidd_det.pidd_pid_oid')
            ->join('pt_mstr', 'pid_det.pid_pt_id', '=', 'pt_mstr.pt_id')
            ->select('pt_mstr.pt_code as id', 'pt_mstr.pt_code as kode_barang', 'pt_mstr.pt_desc1 as nama_barang', 'pt_mstr.pt_desc2', 'pidd_det.pidd_price', 'pidd_det.pidd_payment as harga_barang', 'pidd_det.pidd_disc', 'pt_mstr.pt_gambar as gambar_barang')
            ->whereNotNull('pidd_det.pidd_payment')
            ->where('pi_mstr.pi_so_type', 'R')
            ->where('pi_mstr.pi_active', 'Y')
            ->where('pi_mstr.pi_id', $en_id->value)
            ->where('pidd_det.pidd_payment_type', $pidd_payment_type->value)
            ->where('pt_type', 'I')
            ->where('pt_ppn_type', 'E')
            ->get();

        if ($getbarang) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditampilakn',
                'data' => $getbarang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Produk gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    //
}
