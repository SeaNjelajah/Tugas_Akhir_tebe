<?php

namespace App\Http\Controllers;

use App\Models\tbl_kamar;
use App\Models\tbl_keranjang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home () {
        return view('home');
    }

    public function pengantar () {
        return view('introduction');
    }

    public function gallery () {
        return view('gallery');
    }

    public function contact () {
        return view('contact');
    }

    public function homeSubmit (Request $request) {

        session()->put($request->except(['_token', '_method']));

        if (!session()->has('id_cart')) {

            session()->put([
                "id_cart" => uniqid()
            ]);
        }
        
        if ( $request->get('pilih_kamar_checkbox') ) {
            return redirect()->route('kamar');
        }

        return redirect()->route('home');
    }

    public function kamar_dan_biaya () {
        
        $banyak_kamar = tbl_kamar::where('jumlah_kamar', '>', '0')->get();

        return view('rooms-tariff', compact('banyak_kamar'));
    }

    public function detail_kamar ($id) {
        $kamar = tbl_kamar::find($id);
        
        if ($kamar->jumlah_kamar <= 0) {
            return redirect()->back()->withInput();
        }


        $keranjang = [];

        if ($id_cart = session()->get('id_cart')) {
            $keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%");
        }

        return view('room-details', compact('kamar', 'keranjang'));
    }

    public function kamar_keranjang (Request $request) {

        $request->validate([
            'kamar_terpilih' => ['required', 'numeric']
        ]);



        foreach ($request->get('kamar_terpilih') as $key => $value) {

            $kamar = tbl_kamar::find($key);

            if ($value > $kamar->jumlah_kamar) {

                return redirect()->back()->with('errors', ["jumlah_kamar" => "Jumlah Kamar Salah!"]);
            
            } else if ($value > 0) {

                $keranjang = tbl_keranjang::where('id_kamar', $key)->first();

                if ($keranjang) {

                    if ($keranjang->jumlah != $value) {

                        $kamar->jumlah_kamar += $keranjang->jumlah - $value;
                        $kamar->save();
    
                        $keranjang->update([
                            "jumlah" => $value,
                            'subtotal' => $kamar->harga * $value
                        ]);
                        
                    }

                } else {

                    $kamar->jumlah_kamar -= $value;
                    $kamar->save();

                    tbl_keranjang::create([
                        'id_cart' => session()->get('id_cart'),
                        'id_kamar' => $key,
                        'subtotal' => $kamar->harga * $value
                    ]);

                }
                

            } else {

                $keranjang = tbl_keranjang::where('id_kamar', $key)->first();

                $keranjang->delete();
            
            }
            
        }
    }

    public function selesai (Request $request) {
        dd($request);

        $request->validate();
    }
    

    
}
