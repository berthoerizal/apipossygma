<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
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

    public function addTransaksi(Request $request)
    {
        DB::transaction(function () use ($request) {
            //data shift
            $id = $request->json()->get('id');
            $voucher_id = $request->json()->get('voucher_id');
            $users = DB::table('users')->where('id', $id)->first();
            $voucher_detail_tbl = DB::table('pos_voucher_detail')->where('voucher_id', $voucher_id)->first();
            $shift = DB::table('pos_shift')->where('user_id', $users->id)
            ->where('waktu',date('Y-m-d'))
            ->whereIN('status',['Mulai','Proses'])->first();
            // $en_id = DB::table('pos_konf')
            // ->where('var','en_id')
            // ->first();
            $en_id = DB::table('pos_outlet')->where('id', $users->outlet_id)->first();
            $pricelist_id = DB::table('en_mstr')->where('en_id', $en_id->entitas_id)->first();
            // return $en_id->nama_outlet;

            if ($voucher_detail_tbl->voucher_id <> 'kosong') {
                $transaksi['diskon'] = $voucher_detail_tbl->nominal;
                $transaksi['voucher_id'] = $voucher_detail_tbl->voucher_id;
                $transaksi['kode_voucher'] = $voucher_detail_tbl->kode_voucher;
                $voucher_detail = DB::table('pos_voucher_detail')->where('id', $voucher_detail_tbl->voucher_id)
                                ->update(['status' => '1']);
            } else {
                $transaksi['diskon'] = $request->json()->get('diskon');
            }
            $transaksi['user_id'] = $users->id; //mengambil user id dari kasir
            $transaksi['meja_id'] = $request->json()->get('id_meja'); 
            $transaksi['invoice'] = date('ymdhis');
            $transaksi['shift_id'] = $shift->id;
            $transaksi['nama_pelanggan'] = $request->json()->get('nama_pelanggan');
            $transaksi['tanggal_transaksi'] = date('d-M-y');
            $transaksi['member_id'] = $request->json()->get('member_id');
            $transaksi['en_id'] = $en_id->entitas_id;
            $transaksi['loc_id'] = $en_id->loc_id;
            $transaksi['outlet_id'] = $en_id->id;
            // $transaksi['bk_id'] = $en_id->bk_id;
            // $transaksi['pay_type_id'] = $request->json()->get('pay_type_id');
            $transaksi['pricelist_id'] = $pricelist_id->en_pi_id;
            // $transaksi['invoice_online_food'] = isset($request->invoice_online_food) ? $request->invoice_online_food : NULL;

            //Data dari request Berupa Array
            $barang_id = $request->json()->get('barang_id');
            $kode_barang = $request->json()->get('kode_barang');
            $nama_barang = $request->json()->get('nama_barang');
            $harga_barang = $request->json()->get('harga_barang');
            $qty = $request->json()->get('qty');
            
            $data = DB::table('pos_transaksi')->insertGetId([
                'invoice' => $transaksi['invoice'],
                'user_id' => $transaksi['user_id'],
                'meja_id' => $transaksi['meja_id'],
                'nama_pelanggan' => $transaksi['nama_pelanggan'],
                'shift_id' => $transaksi['shift_id'],
                'tanggal_transaksi' => $transaksi['tanggal_transaksi'],
                'pricelist_id' => $transaksi['pricelist_id'],
                'member_id' => $transaksi['member_id'],
                'voucher_id' => $transaksi['voucher_id'],
                'kode_voucher' => $transaksi['kode_voucher']
            ]);
            $sisa = 0; 
            $_SESSION['id'] = $data;
            for ($i=0; $i < count($kode_barang); $i++) { 
                $produk = DB::table('pt_mstr')->where('pt_code', $kode_barang[$i])->first();
                $detail_transaksi['transaksi_id'] = $data;// mengambil id dari transaksi atas
                $detail_transaksi['barang_id'] = $produk->pt_id;
                $detail_transaksi['kode_barang'] = $kode_barang[$i];
                $detail_transaksi['nama_barang'] = $nama_barang[$i];
                $detail_transaksi['harga_barang'] = $harga_barang[$i];
                $detail_transaksi['qty'] = $qty[$i];
                $detail_transaksi['total_harga'] = $qty[$i] * $harga_barang[$i];

                // DetailTransaksi::create($detail_transaksi); //save detail transaksi
                $detail = DB::table('pos_transaksi')->where('id', $data)->first();
                DB::table('pos_detail_transaksi')->insert([
                    'transaksi_id' => $detail->id,
                    'barang_id' => $detail_transaksi['barang_id'],
                    'kode_barang' => $detail_transaksi['kode_barang'],
                    'nama_barang' => $detail_transaksi['nama_barang'],
                    'harga_barang' => $detail_transaksi['harga_barang'],
                    'qty' => $detail_transaksi['qty'],
                    'total_harga' => $detail_transaksi['total_harga']
                ]);
            }
        }, 5);
        return response()->json([
            'success' => true,
            'message' => 'Data Voucher berhasil di simpan'
            ]);
    }
}