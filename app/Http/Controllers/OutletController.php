<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OutletController extends Controller
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

    public function getOutlet()
    {
        $getoutlet = DB::table('pos_outlet')
            ->join('en_mstr', 'pos_outlet.entitas_id', '=', 'en_mstr.en_id')
            ->join('loc_mstr', 'pos_outlet.loc_id', '=', 'loc_mstr.loc_id')
            ->join('bk_mstr', 'pos_outlet.bk_id', '=', 'bk_mstr.bk_id')
            ->select('pos_outlet.*', 'en_mstr.en_desc as nama_entitas', 'loc_mstr.loc_desc as lokasi', 'bk_mstr.bk_name as nama_bank')
            ->get();

        if ($getoutlet) {
            return response()->json([
                'success' => true,
                'message' => 'Outlet berhasil ditampilkan',
                'data' => $getoutlet
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Outlet gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    public function addOutlet(Request $request)
    {
        $entitas_id = $request->json()->get('entitas_id');
        $nama_outlet = $request->json()->get('nama_outlet');
        $alamat = $request->json()->get('alamat');
        $no_outlet = $request->json()->get('no_outlet');
        $loc_id = $request->json()->get('loc_id');
        $bk_id = $request->json()->get('bk_id');

        $addoutlet = DB::table('pos_outlet')->insert([
            'entitas_id' => $entitas_id,
            'nama_outlet' => $nama_outlet,
            'alamat' => $alamat,
            'no_outlet' => $no_outlet,
            'loc_id' => $loc_id,
            'bk_id' => $bk_id
        ]);

        if ($addoutlet) {
            return response()->json([
                'success' => true,
                'message' => 'Outlet berhasil ditambahkan',
                'data' => $addoutlet
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Outlet gagal ditambahkan',
                'data' => ''
            ], 400);
        }
    }

    public function deleteOutlet($id)
    {
        $deleteoutlet = DB::table('pos_outlet')->where('id', $id)->delete();

        if ($deleteoutlet) {
            return response()->json([
                'success' => true,
                'message' => 'Outlet berhasil dihapus',
                'data' => $deleteoutlet
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Outlet gagal dihapus',
                'data' => ''
            ], 400);
        }
    }

    public function updateOutlet(Request $request, $id)
    {
        $entitas_id = $request->json()->get('entitas_id');
        $nama_outlet = $request->json()->get('nama_outlet');
        $alamat = $request->json()->get('alamat');
        $no_outlet = $request->json()->get('no_outlet');
        $loc_id = $request->json()->get('loc_id');
        $bk_id = $request->json()->get('bk_id');

        $updateoutlet = DB::table('pos_outlet')->where('id', $id)->update([
            'entitas_id' => $entitas_id,
            'nama_outlet' => $nama_outlet,
            'alamat' => $alamat,
            'no_outlet' => $no_outlet,
            'loc_id' => $loc_id,
            'bk_id' => $bk_id
        ]);

        if ($updateoutlet) {
            return response()->json([
                'success' => true,
                'message' => 'Outlet berhasil diupdate',
                'data' => $updateoutlet
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Outlet gagal diupdate',
                'data' => ''
            ], 201);
        }
    }

    //
}
