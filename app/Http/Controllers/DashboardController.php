<?php

namespace App\Http\Controllers;

use App\Models\tbl_kode_kamar;
use App\Models\tbl_konfirmasi_checkin;
use App\Models\tbl_pembayaran;
use App\Models\tbl_reservasi;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $paginate = 5;

        $banyak_reservasi = tbl_reservasi::where('status', 'Reservasi')->orderBy('created_at', 'asc')->paginate( $paginate );
        $banyak_tamu = tbl_konfirmasi_checkin::orderBy('created_at', 'asc')->paginate( $paginate );
        

        $now = Carbon::now();

        $between = "month";

        $Start = $now->startOf($between)->toDateTimeLocalString();
        $End = $now->EndOf($between)->toDateTimeLocalString();
        
        $total_checkin = tbl_konfirmasi_checkin::whereBetween('created_at', [$Start, $End])->count();
        $total_pendapatan = tbl_pembayaran::whereBetween('pada_tanggal', [$Start, $End])->sum('pembayaran');

        $total_reservasi = tbl_reservasi::where('status', 'Reservasi')->count();
        $total_terisi = tbl_kode_kamar::where('terisi', true)->count();

        return view('admin.dashboard.index', compact('banyak_reservasi', 'banyak_tamu', 'total_checkin', 'total_pendapatan', 'total_reservasi', 'total_terisi'));
    }

    
}
