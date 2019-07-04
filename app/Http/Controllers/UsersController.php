<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Validator;

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
        $users = DB::table('tconfusers')->where('userid', $id)->first();

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

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $validator = Validator::make(
            [
                'username' => $username,
                'password' => $password
            ],
            [
                'username' => 'required',
                'password' => 'required|min:6|max:12',
            ]
        );

        if ($validator->fails()) {
            // The given data did not pass validation
            return response()->json($validator->errors(), 422);
        } else {
            $user = User::where('username', $username)->first();

            if (Hash::check($password, $user->password)) {
                $apiToken = base64_encode(str_random(40));

                $user->update([
                    'api_token' => $apiToken
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Login Success',
                    'date' => [
                        'user' => $user,
                        'api_token' => $apiToken
                    ]
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Fail',
                    'date' => ''
                ], 400);
            }
        }
    }

    //
}
