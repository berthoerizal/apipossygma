<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        $this->middleware('auth',  ['except' => ['login']]);
    }

    public function store(Request $request)
    {

        $userid = $request->json()->get('userid');
        $users = DB::table('tconfuser')->where('userid', $userid)->first();
        $add = User::create([
            'name' =>  $users->usernama,
            'email' => $users->usernama,
            'password' => Hash::make($users->password),
            'admin' => $users->en_id,
            'userid' => $users->userid,
            'ptnr_id' => $users->user_ptnr_id,
            'username' => $users->usernama
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

    public function destroy($id)
    {
        $deleted = DB::table('users')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'User delete success',
                'data' => $deleted
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User delete fail',
                'data' => ''
            ], 400);
        }
    }

    public function updateUser($userid)
    {
        $users = DB::table('tconfuser')->where('userid', $userid)->first();
        $updated = DB::table('users')->where('userid', $userid)->update([
                'userid' => $userid,
                'name' =>  $users->usernama,
                'email' => $users->usernama,
                'password' => Hash::make($users->password),
                'admin' => $users->en_id,
                'userid' => $users->userid,
                'ptnr_id' => $users->user_ptnr_id,
                'username' => $users->usernama
            ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'User update success',
                'data' => $updated
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User update fail',
                'data' => ''
            ], 400);
        }
    }

    public function login(Request $request)
    {
        $username = $request->json()->get('username');
        $password = $request->json()->get('password');

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
