<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
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
        
        $userid = $request->input('userid');
        $email = $request->input('email');
        $users = DB::table('tconfuser')->where('userid', $userid)->first();
        $add = User::create([
            'name' =>  $users->usernama,
            'email' => $email,
            'password' => Hash::make($users->password),
            'admin'=> $users->en_id,
            'userid' => $users->userid,
            'ptnr_id'=>$users->user_ptnr_id,
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
        $deleted = DB::table('users')->where('id',$id)->delete();

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

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

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

    //
}
