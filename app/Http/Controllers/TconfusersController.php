<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TconfusersController extends Controller
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

    public function getTconfuser()
    {
        $gettconfuser = DB::table('tconfuser')->get();

        if ($gettconfuser) {
            return response()->json([
                'success' => true,
                'message' => 'Tconfuser berhasil ditampilkan',
                'data' => $gettconfuser
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tconfuser gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    //
}
