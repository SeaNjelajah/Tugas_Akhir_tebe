<?php

namespace App\Http\Controllers;

use App\Models\tbl_reservasi;
use Illuminate\Http\Request;

class DaftarTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;

        $daftar_tamu = tbl_reservasi::where('status', 'Check In')->paginate ( $paginate );

        if ($search = $request->get('search')) {
            $daftar_tamu = tbl_reservasi::where('status', 'Check In')->search( $search )->paginate( $paginate );
        }


        return view('admin.daftar_tamu.index', compact('daftar_tamu'));
    }

    public function checkout ($id) {
        $reservasi = tbl_reservasi::find($id);
        $status = $reservasi->status;

        if ($status == "Check In") {

            $reservasi->check_out()->create([]);

            $reservasi->kode_kamar()->update([
                "terisi" => false
            ]);

            foreach ($reservasi->kode_kamar as $kode_kamar) {
                $kode_kamar->kamar()->dissociate();
            }
            

            $reservasi->update([
                "status" => "Check Out"
            ]);

            return redirect()->back()->with("success");
        }


        return redirect()->back();
        
    }
}
