<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LocationController extends Controller
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

    public function getLocation()
    {
        $getloc = DB::table('loc_mstr')
            ->where('loc_active', 'Y')
            ->get();
        $getbk = DB::table('bk_mstr')
            ->where('bk_active', 'Y')
            ->get();

        if ($getloc && $getbk) {
            return response()->json([
                'success' => true,
                'message' => 'loc dan bk berhasil ditampilkan',
                'loc' => $getloc,
                'bk' => $getbk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'loc dan bk gagal ditampilkan',
                'loc' => '',
                'bk' => ''
            ], 404);
        }
    }
}
