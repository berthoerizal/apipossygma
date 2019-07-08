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
        // $this->middleware('auth');
    }

    public function entitas()
    {
        $getentitas = DB::table('en_mstr')->get();

        if ($getentitas) {
            return response()->json([
                'success' => true,
                'message' => 'Select Entitas success!',
                'data' => $getentitas
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
