<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersApi extends Controller
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

    public function store(Request $request)
    {
        $username = $request->input('username');
        $password = Hash::make($request->input('password'));

        $add = User::create([
            'username' => $username,
            'password' => $password
        ]);

        if ($add) {
            return response()->json([
                'success' => true,
                'message' => 'User add success',
                'data' => $add
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User add fail',
                'data' => ''
            ], 400);
        }
    }

    //
}
