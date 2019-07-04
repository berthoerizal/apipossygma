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
        //
    }

    public function entitas()
    {
        $entitas = DB::table('en_mstr')->get();

        if ($entitas) {
            return response()->json([
                'success' => true,
                'message' => 'Select Entitas success!',
                'data' => $entitas
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
