<?php

namespace App\Http\Controllers;

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

        if (!$request->between == "all") {

            if (!empty($request->mulai_sewa) and !empty($request->akhir_sewa)) {
    
                $Start = Carbon::create($request->mulai_sewa)->toDateTimeLocalString();
                $End = Carbon::create($request->akhir_sewa)->toDateTimeLocalString();
    
            } else {

                if (!empty($request->between)) {
                    $between = $request->between;
                } else {
                    $between = "week";
                }
                
                $now = Carbon::now();
    
                $Start = $now->startOf($between)->toDateTimeLocalString();
                $End = $now->EndOf($between)->toDateTimeLocalString();
            }
            
            $data = tbl_reservasi::where('status', 'Check Out')->whereBetween('created_at', [$Start, $End]);
            
            $total = $data->sum('pembayaran');
            $banyak_laporan = $data->get();

        } else {

            $banyak_laporan = tbl_reservasi::where('status', 'Check Out')->get();
            $total = $banyak_laporan->sum('pembayaran');

        }

        return view('admin.laporan_keuangan.index', compact('banyak_laporan', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
