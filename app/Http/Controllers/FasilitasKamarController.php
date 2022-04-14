<?php

namespace App\Http\Controllers;

use App\Models\tbl_fasilitas;
use Illuminate\Http\Request;

class FasilitasKamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 5;

        $banyak_fasilitas = tbl_fasilitas::paginate ( $paginate );

        if ($search = $request->get('search')) {
            $banyak_fasilitas = tbl_fasilitas::search( $search )->paginate( $paginate );
        }

        return view('admin.fasilitas_kamar.index', compact('banyak_fasilitas'));        
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fasilitas' => 'required'
        ]);

        tbl_fasilitas::create( $request->all() );

        return redirect()->route('admin.fasilitas.index')->with('success', 'Berhasil Menyimpan Data');
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
        $request->validate([
            'fasilitas' . $id => 'required'
        ]);

        tbl_fasilitas::find($id)->update([
            'fasilitas' => $request->get('fasilitas' . $id)
        ]);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Berhasil Meng edit Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        tbl_fasilitas::find($id)->delete();

        return redirect()->route('admin.fasilitas.index')->with('success', 'Berhasil Menghapus Data');
    }
}
