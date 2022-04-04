<?php

namespace App\Http\Controllers;

use App\Models\tbl_reservasi;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservasi = tbl_reservasi::all();
        return view('admin.reservasi.index', compact('reservasi'));
    }

    private $rules = [
        'nama_tamu' => ['required'],
        'email' => ['required', 'email'],
        'no_tlp' => ['required'],
        
        'jumlah_k' => ['required', 'numeric'],
        'jumlah_d' => ['required', 'numeric'],
        'jumlah_a' => ['required', 'numeric'],

        'check_in' => ['required', 'datetime'],
        'check_out' => ['required', 'datetime'],

        'pesan_lain' => ['required'],
    ];

    private $message = [
        "nama_tamu.required" => "Nama Kamar perlu di isi!",

        "email.required" => "Email perlu di isi!",
        "email.email" => "Email Salah!",

        "no_tlp.required" => "Nomor Telepon perlu di isi!",

        "jumlah_k.required" => "Jumlah Kamar perlu di isi!",
        "jumlah_k.numeric" => "Jumlah Kamar harus angka!",

        "jumlah_d.required" => "Jumlah Orang Dewasa perlu di isi!",
        "jumlah_d.numeric" => "Jumlah Orang harus angka!",

        "jumlah_a.required" => "Jumlah Anak - Anak perlu di isi!",
        "jumlah_a.numeric" => "Jumlah Anak - Anak harus angka!",

        "check_in.required" => "Check In perlu di isi!",
        "check_in.datetime" => "Check In harus tanggal!",

        "check_out.required" => "Check Out perlu di isi!",
        "check_out.datetime" => "Check Out harus tanggal!",

        "pesan_lain.required" => "Pesan Lain perlu di isi!",
    ];


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reservasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.reservasi.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.reservasi.edit');
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
