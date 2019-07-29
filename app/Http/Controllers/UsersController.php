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
        // $this->middleware('auth',  ['except' => ['login']]);
    }

    public function getUsers(Request $request)
    {
        $getuser = DB::table('users')
            ->leftJoin('pos_outlet', 'users.outlet_id', '=', 'pos_outlet.id')
            ->leftJoin('en_mstr', 'pos_outlet.entitas_id', '=', 'en_mstr.en_id')
            ->select('users.*', 'pos_outlet.nama_outlet as outlet', 'en_mstr.en_desc as nama_entitas')
            ->get();

        if ($getuser) {
            return response()->json([
                'success' => true,
                'message' => 'data users berhasil ditampilkan',
                'data' => $getuser
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data users gagal ditampilkan',
                'data' => ''
            ], 404);
        }
    }

    public function addUser(Request $request)
    {
        $userid = $request->json()->get('userid');
        $outlet_id = $request->json()->get('outlet_id');
        $users = DB::table('tconfuser')->where('userid', $userid)->first();

        $add = DB::table('users')->insert([
            'name' =>  $users->usernama,
            'email' => $users->usernama,
            'password' => Hash::make($users->password),
            'admin' => $users->en_id,
            'userid' => $users->userid,
            'ptnr_id' => $users->user_ptnr_id,
            'outlet_id' => $outlet_id,
            'username' => $users->usernama,
        ]);

        if ($add) {
            return response()->json([
                'success' => true,
                'message' => 'data users berhasil ditambahkan',
                'data' => $add
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data users gagal ditambahkan',
                'data' => ''
            ], 400);
        }
    }

    public function deleteUser($id)
    {
        $deleted = DB::table('users')->where('id', $id)->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'data users berhasil dihapus',
                'data' => $deleted
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data users gagal dihapus',
                'data' => ''
            ], 400);
        }
    }

    public function updateUser(Request $request, $userid)
    {
        $outlet_id = $request->json()->get('outlet_id');
        $users = DB::table('tconfuser')->where('userid', $userid)->first();
        $updated = DB::table('users')->where('userid', $userid)->update([
            'userid' => $userid,
            'name' =>  $users->usernama,
            'email' => $users->usernama,
            'password' => Hash::make($users->password),
            'admin' => $users->en_id,
            'userid' => $users->userid,
            'ptnr_id' => $users->user_ptnr_id,
            'outlet_id' => $outlet_id,
            'username' => $users->usernama
        ]);

        if ($updated) {
            return response()->json([
                'success' => true,
                'message' => 'data users berhasil diubah',
                'data' => $updated
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data users gagal diubah',
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
                    'message' => 'Login Berhasil',
                    'date' => [
                        'user' => $user,
                        'api_token' => $apiToken
                    ]
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Gagal',
                    'date' => ''
                ], 400);
            }
        }
    }

    //
}
