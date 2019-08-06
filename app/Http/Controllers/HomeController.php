<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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

    public function index()
    {
        // $user = Auth::user()->id;
        // if ($user) {
        //     return response()->json([
        //         'message' => 'success',
        //         'data' => $user
        //     ], 200);
        // } else {
        //     return response()->json([
        //         'message' => 'fail',
        //         'data' => ''
        //     ], 400);
        // }

        return "success";
    }

    //
}
