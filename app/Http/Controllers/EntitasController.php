<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use \App\User;

class EntitasController extends Controller
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

    public function getEntitas()
    {
        $getentitas = DB::table('en_mstr')->get();

        if ($getentitas) {
            return response()->json([
                'success' => true,
                'message' => 'data entitas berhasil ditampilkan',
                'data' => $getentitas
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data konfigurasi gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    //
}
