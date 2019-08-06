<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class VoucherController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $kode_utama_voucher = $request->json()->get('kode_utama_voucher');
        $nama_voucher = $request->json()->get('nama_voucher');
        $tanggal_mulai = $request->json()->get('tanggal_mulai');
        $tanggal_akhir = $request->json()->get('tanggal_akhir');
        $jumlah = $request->json()->get('jumlah');
        $keterangan = $request->json()->get('keterangan');
        $nominal_voucher = $request->json()->get('nominal_voucher');

        $data = DB::table('pos_voucher')->insertGetId([
            // 'id' => $id,
            'kode_utama_voucher' => $kode_utama_voucher,
            'nama_voucher' => $nama_voucher,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'jumlah' => $jumlah,
            'keterangan' => $keterangan,
            'nominal_voucher' => $nominal_voucher
        ]);
        for ($i = 0; $i < $jumlah; $i++) {
            $possible = '23456789bcdfghjklmnpqrstvwxyz';
            $code = '';
            $j = 0;
            while ($j < 6) {
                $code .= substr($possible, mt_rand(0, strlen($possible) - 1), 1);
                $j++;
            }
            $voucher_detail = DB::table('pos_voucher')->where('id', $data)->first();

            $add_detail = DB::table('pos_voucher_detail')->insert([
                'voucher_id' =>  $voucher_detail->id,
                'kode_voucher' => $voucher_detail->kode_utama_voucher . $code,
                'nominal' => $voucher_detail->nominal_voucher
            ]);
        }
        if ($add_detail) {
            return response()->json([
                'success' => true,
                'message' => 'voucher detail berhasil ditambahkan',
                'data' => $add_detail
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'voucher detail gagal ditambahkan',
                'data' => ''
            ], 400);
        }
    }

    public function detailVoucher($id)
    {
        $detailvoucher = DB::table('pos_voucher_detail')->where('voucher_id', $id)->get();
        if ($detailvoucher) {
            return response()->json([
                'success' => true,
                'message' => 'voucher detail berhasil ditampilkan',
                'data' => $detailvoucher
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'voucher detail gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    public function getVoucher()
    {
        $getvoucher = DB::table('pos_voucher')->get();

        if ($getvoucher) {
            return response()->json([
                'success' => true,
                'message' => 'data voucher berhasil ditampilkan',
                'data' => $getvoucher
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data voucher gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $nama_voucher = $request->json()->get('nama_voucher');
        $tanggal_mulai = $request->json()->get('tanggal_mulai');
        $tanggal_akhir = $request->json()->get('tanggal_akhir');
        $keterangan = $request->json()->get('keterangan');
        $nominal_voucher = $request->json()->get('nominal_voucher');

        $voucher = DB::table('pos_voucher')->where('id', $id)->update([
            'nama_voucher' => $nama_voucher,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_akhir' => $tanggal_akhir,
            'keterangan' => $keterangan,
            'nominal_voucher' => $nominal_voucher
        ]);

        $update_detail = DB::table('pos_voucher')->where('id', $id)->first();

        $updated = DB::table('pos_voucher_detail')->where('voucher_id', $id)->update([
            // 'voucher_id' =>  $update_detail->id,
            // 'kode_voucher' => $update_detail->kode_utama_voucher .$code,
            'nominal' => $update_detail->nominal_voucher
        ]);
        // return $voucher;
        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'data voucher berhasil diubah',
                'data' => $updated
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data voucher berhasil diubah',
                'data' => ''
            ], 404);
        }
    }

    public function destroy($id)
    {

        $deleted = DB::table('pos_voucher')->where('id', $id)->delete();
        $delete = DB::table('pos_voucher_detail')->where('voucher_id', $id)->delete();

        if ($delete) {
            return response()->json([
                'success' => true,
                'message' => 'data voucher berhasil dihapus',
                'data' => $delete
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data voucher berhasil dihapus',
                'data' => ''
            ], 400);
        }
    }
    //
}
