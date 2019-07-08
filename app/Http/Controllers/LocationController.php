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
        $this->middleware('auth');
    }

    public function getLocation()
    {
        $loc = DB::table('loc_mstr')
            ->where('loc_active', 'Y')
            ->get();
        $bk = DB::table('bk_mstr')
            ->where('bk_active', 'Y')
            ->get();

        if ($loc && $bk) {
            return response()->json([
                'success' => true,
                'message' => 'Suskses menampilkan data',
                'loc' => $loc,
                'bk' => $bk
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data',
                'loc' => '',
                'bk' => ''
            ], 404);
        }
    }
}
