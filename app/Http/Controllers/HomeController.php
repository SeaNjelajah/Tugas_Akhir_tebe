<?php

namespace App\Http\Controllers;

use App\Models\tbl_kamar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home () {
        return view('home');
    }

    public function kamar_dan_biaya () {
        
        $banyak_kamar = tbl_kamar::where('status', 'Tersedia')->get();

        return view('rooms-tariff', compact('banyak_kamar'));
    }

    public function detail_kamar ($id) {
        $kamar = tbl_kamar::find($id);
        return view('room-details', compact('kamar'));
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

    
}
