<?php

namespace App\Http\Controllers;

use App\Models\tbl_reservasi;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 15;

        $banyak_riwayat = tbl_reservasi::where('status', 'Check Out')->orWhere('status', 'Dibatalkan')->paginate ( $paginate );

        if ($search = $request->get('search')) {
            $banyak_riwayat = tbl_reservasi::where('status', 'Check Out')->orWhere('status', 'Dibatalkan')->search( $search )->paginate( $paginate );
        }

        return view('admin.riwayat.index', compact('banyak_riwayat') );
    }

   
}
