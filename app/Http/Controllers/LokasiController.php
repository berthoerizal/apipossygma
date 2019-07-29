<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LokasiController extends Controller
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

    public function getLokasi()
    {
        $getloc = DB::table('loc_mstr')
            ->where('loc_active', 'Y')
            ->get();

        if ($getloc) {
            return response()->json([
                'success' => true,
                'message' => 'Lokasi berhasil ditampilkan',
                'data' => $getloc
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Lokasi gagal ditampilkan',
                'data' => '',
            ], 404);
        }
    }
}
