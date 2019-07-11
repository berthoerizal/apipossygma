<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShiftController extends Controller
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

    public function getShift()
    {
        $getshift = DB::table('pi_mstr')->get();

        if ($getshift) {
            return response()->json([
                'success' => true,
                'message' => 'Shift berhasil ditampilkan',
                'data' => $getshift
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Shift gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    public function addShift(Request $request)
    {
        $user_id = $request->json()->get('user_id');
        $kode_shift = $request->json()->get('kode_shift');
        $status = "Mulai";
        $modal_awal = $request->json()->get('modal_awal');
        $print = $request->json()->get('print');
        $waktu = $request->json()->get('waktu');
        $waktu_akhir = $request->json()->get('waktu_akhir');

        try {
            DB::beginTransaction();
            $data_shift = $request->all();
            $tanggal = date('Y-M-d', strtotime($waktu));
            $tanggal_akhir = isset($waktu_akhir) ? date('Y-M-d', strtotime('+1 days', strtotime($waktu_akhir))) : date('Y-M-d', strtotime('+1 days', strtotime($waktu)));
            $data_ada = false;
            $i = 1;
            $sisa = strtotime($tanggal_akhir) - strtotime($tanggal);
            $sisa = floor($sisa / (60 * 60 * 24));
            while (($i <= $sisa) and ($data_ada <> true)) {
                DB::table('pos_shift')->insert([
                    'user_id' => $user_id,
                    'kode_shift' => $kode_shift,
                    'waktu' => $tanggal,
                    'status' => $status,
                    'modal_awal' => $modal_awal,
                    'print' => $print
                ]);

                $tanggal = date('Y-M-d', strtotime('+1 day', strtotime($tanggal)));
                $i++;
            }
            if ($data_ada) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Data Shift Sudah Ada'
                ]);
            } else {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Data Barang berhasil di simpan'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => "Terjadi Keselahan Saat Menyimpan Data! " . $e
            ]);
        }
    }

    public function deleteShift($id)
    {
        $deleted = DB::table('pos_shift')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Shift berhasil dihapus',
                'data' => $deleted
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Shift gagal dihapus',
                'data' => ''
            ], 400);
        }
    }

    public function updateShift(Request $request, $id)
    {
        $user_id = $request->json()->get('user_id');
        $kode_shift = $request->json()->get('kode_shift');
        $status = "Mulai";
        $modal_awal = $request->json()->get('modal_awal');
        $print = $request->json()->get('print');
        $waktu = $request->json()->get('waktu');
        $waktu_akhir = $request->json()->get('waktu_akhir');

        try {
            DB::beginTransaction();
            $data_shift = $request->all();
            $tanggal = date('Y-M-d', strtotime($waktu));
            $tanggal_akhir = isset($waktu_akhir) ? date('Y-M-d', strtotime('+1 days', strtotime($waktu_akhir))) : date('Y-M-d', strtotime('+1 days', strtotime($waktu)));
            $data_ada = false;
            $i = 1;
            $sisa = strtotime($tanggal_akhir) - strtotime($tanggal);
            $sisa = floor($sisa / (60 * 60 * 24));
            while (($i <= $sisa) and ($data_ada <> true)) {
                DB::table('pos_shift')->where('id', $id)->update([
                    'user_id' => $user_id,
                    'kode_shift' => $kode_shift,
                    'waktu' => $tanggal,
                    'status' => $status,
                    'modal_awal' => $modal_awal,
                    'print' => $print
                ]);

                $tanggal = date('Y-M-d', strtotime('+1 day', strtotime($tanggal)));
                $i++;
            }
            if ($data_ada) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Data Shift Sudah Ada'
                ]);
            } else {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Data Barang berhasil di simpan'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => "Terjadi Keselahan Saat Menyimpan Data! " . $e
            ]);
        }
    }
}
