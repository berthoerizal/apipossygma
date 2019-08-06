<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class BankController extends Controller
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

    public function getBank()
    {
        $getbank = DB::table('bk_mstr')
            ->where('bk_active', 'Y')
            ->get();

        if ($getbank) {
            return response()->json([
                'success' => true,
                'message' => 'Bank berhasil ditampilkan',
                'data' => $getbank
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Bank gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }
}
