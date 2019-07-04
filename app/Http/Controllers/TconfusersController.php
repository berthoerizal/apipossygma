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
        //
    }

    public function getTconfuser()
    {
        $users = DB::table('tconfusers')->get();

        if ($users) {
            return response()->json([
                'success' => true,
                'message' => 'Success',
                'data' => $users
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
