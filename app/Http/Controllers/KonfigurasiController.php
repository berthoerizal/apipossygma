<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KonfigurasiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth',  ['except' => ['login']]);
    }

    public function getKonfigurasi()
    {
        $konf = DB::table('pos_konf')->get();

        if ($konf) {
            return response()->json([
                'success' => true,
                'message' => 'Select Entitas success!',
                'data' => $konf
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail',
                'data' => ''
            ], 404);
        }
    }

    public function insertKonfigurasi(Request $request)
    {
        $var = $request->json()->get('var');
        $value = $request->json()->get('value');
        $remark = $request->json()->get('remark');

        $addkonf = DB::table('pos_konf')->insert([
            'var' => $var,
            'value' => $value,
            'remark' => $remark
        ]);

        if ($addkonf) {
            return response()->json([
                'success' => true,
                'message' => 'Select konfigurasi success!',
                'data' => $addkonf
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail',
                'data' => ''
            ], 404);
        }
    }

    public function deleteKonfigurasi($id)
    {
        $deleted = DB::table('pos_konf')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Konfigurasi berhasil dihapus',
                'data' => $deleted
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Konfigurasi gagal dihapus',
                'data' => ''
            ], 400);
        }
    }

    public function updateKonfigurasi(Request $request, $id)
    {
        $var = $request->json()->get('var');
        $value = $request->json()->get('value');
        $remark = $request->json()->get('remark');

        $updatekonf = DB::table('pos_konf')->where('id', $id)->update([

            'var' => $var,
            'value' => $value,
            'remark' => $remark

        ]);

        if ($updatekonf) {
            return response()->json([
                'success' => true,
                'message' => 'Select konfigurasi success!',
                'data' => $updatekonf
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Fail',
                'data' => ''
            ], 404);
        }
    }
    //
}
