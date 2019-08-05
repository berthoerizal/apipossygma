<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class TransaksiExport implements FromCollection
{
    use Exportable;

    public function tanggal($tanggal_mulai, $tanggal_selesai)
    {
        $this->tanggal_mulai = $tanggal_mulai;
        $this->tanggal_selesai = $tanggal_selesai;

        return $this;
    }

    public function collection()
    {
        return  DB::table('pos_transaksi')->whereBetween('tanggal_transaksi', [$this->tanggal_mulai, $this->tanggal_selesai])->get();
    }
}
