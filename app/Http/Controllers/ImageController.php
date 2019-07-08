<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ImageController extends Controller
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

    public function updateImage(Request $request, $pt_id)
    {
        $file = $request->file('pt_gambar');
        // return storage_path('').'/../../upload/';
        $filename = '/upload/' . uniqid() . $file->getClientOriginalName();
        if ($file->move(storage_path('') . '/../public/upload/image', $filename)) {
            $input['pt_gambar'] = $filename;

            // $user = User::where('id', $id)->update($input);

            $updateimage = DB::table('pt_mstr')->where('pt_id', $pt_id)->update($input);

            if ($updateimage) {
                return response()->json([
                    'success'   => true,
                    'message'   => 'Gambar berhasil diupdate',
                    'data'      => $updateimage
                ], 201);
            } else {
                return response()->json([
                    'success'   => false,
                    'message'   => 'Gambar gagal diupdate',
                    'data'      => ''
                ], 400);
            }
        } else {
            return response()->json([
                'success'   => false,
                'message'   => 'Gambar gagal diupdate',
                'data'      => ''
            ], 400);
        }
    }

    //
}
