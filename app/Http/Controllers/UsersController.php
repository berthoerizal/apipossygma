<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
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
        $id = $request->input('id');
        $users = DB::table('tconfuser')->where('userid', $id)->first();

        $password = Hash::make($request->input('password'));

        $add = User::create([
            'username' => $users->usernama,
            'password' => Hash::make($users->password),
            'name' =>  $users->usernama,
            'email' => $users->email,
            'userid' => $id
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
