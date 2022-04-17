<?php

namespace App\Http\Controllers;

use App\Models\tbl_pembayaran;
use App\Models\tbl_reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class LaporanKeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->get('between') == "all") {

            $banyak_laporan = tbl_pembayaran::all();
            $total = $banyak_laporan->sum('pembayaran');

        } else {
            
            if (!empty($request->mulai_sewa) and !empty($request->akhir_sewa)) {
    
                $Start = Carbon::create($request->mulai_sewa)->toDateTimeLocalString();
                $End = Carbon::create($request->akhir_sewa)->toDateTimeLocalString();
    
            } else {

                if ($value = $request->get('between')) {
                    $between = $value;
                } else {
                    $between = "week";
                }
                
                $now = Carbon::now();
    
                $Start = $now->startOf($between)->toDateTimeLocalString();
                $End = $now->EndOf($between)->toDateTimeLocalString();
            }
            
            $data = tbl_pembayaran::whereBetween('pada_tanggal', [$Start, $End]);
            
            $total = $data->sum('pembayaran');
            $banyak_laporan = $data->get();

        }

        return view('admin.laporan_keuangan.index', compact('banyak_laporan', 'total'));
    }

    
}
