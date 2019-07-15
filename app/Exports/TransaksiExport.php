<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class TransaksiExport implements FromView
{
    public function view(): View
    {
        return view(
            'transaksi',
            ['gettransaksi' => DB::table('pos_transaksi')->get()]
        );
    }
}
