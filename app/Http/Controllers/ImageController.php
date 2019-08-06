<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $this->middleware('auth');
    }

    public function updateImage(Request $request, $pt_id)
    {
        $produk = DB::table('pt_mstr')->where('pt_id', $pt_id)->first();
        $old_image = $produk->pt_gambar;

        if ($request->photo) {

            $exploded = explode(',', $request->photo);

            $decoded = base64_decode($exploded[1]);

            if (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $filename = time() . str_random() . '.' . $extension;

            $path = public_path() . '/upload/image/' . $filename;

            if (file_put_contents($path, $decoded)) {

                $old_pt_gambar = public_path('upload/image/') . $old_image;
                if (file_exists($old_pt_gambar)) {
                    @unlink($old_pt_gambar);
                }

                $input['pt_gambar'] = $filename;
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
    }
}
