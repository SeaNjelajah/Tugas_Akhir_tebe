<?php

namespace App\Http\Controllers;

use App\Models\tbl_kamar;
use App\Models\tbl_reservasi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 15;

        $banyak_reservasi = tbl_reservasi::where('status', 'Reservasi')->paginate ( $paginate );

        if ($search = $request->get('search')) {
            $banyak_reservasi = tbl_reservasi::search( $search )->where('status', 'Reservasi')->paginate( $paginate );
        }

        return view('admin.reservasi.index', compact('banyak_reservasi'));
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banyak_kamar = tbl_kamar::all();
        return view('admin.reservasi.create', compact('banyak_kamar'));
    }

    private $rules = [
        'nama_tamu' => 'required',
        'email' => 'required|email',
        'no_tlp' => 'required',

        'jumlah_k' => 'required|numeric',
        'jumlah_d' => 'required|numeric',
        'jumlah_a' => 'required|numeric',

        'check_in' => ['nullable','date'],
        'check_out' => 'required|date',

        'pesan_lain' => 'required'
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

        // "check_in.required" => "Check In perlu di isi!",
        "check_in.datetime" => "Check In harus tanggal!",

        "check_out.required" => "Check Out perlu di isi!",
        "check_out.datetime" => "Check Out harus tanggal!",

        "pesan_lain.required" => "Pesan Lain perlu di isi!",
    ];

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate($this->rules, $this->message);
        
        do {
            $qrcode = Str::random(10);
            $qrcode = Str::upper($qrcode);
        } while (tbl_reservasi::where('qrcode', 'like', "%$qrcode%")->first());
        
        if ($request->get('check_in_checkbox')) {
            $check_in = $request->get('check_in');
        } else {
            $check_in = now()->toDateTimeLocalString();
        }
        
        $durasi = Carbon::create($check_in)->diffInDays(Carbon::create($request->get('check_out')));

        $reservasi = tbl_reservasi::create( array_merge ( $request->all(), compact('qrcode', 'check_in', 'durasi') ) );
        
        if ($bag = $request->get('kamar_terpilih')) {

            $pembayaran = 0;

            foreach ($bag as $id_kamar => $jumlah_kamar) {

                $kamar = tbl_kamar::find($id_kamar);
                $kamar->jumlah_kamar -= $jumlah_kamar;
                $kamar->save();

                $subtotal = $kamar->harga * $jumlah_kamar;

                $pembayaran += $subtotal;

                $reservasi->kamar()->attach($id_kamar, compact('jumlah_kamar', 'subtotal'));
            }

            $reservasi->update( compact('pembayaran') );

        }

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $reservasi = tbl_reservasi::find($id);
        return view('admin.reservasi.show', compact('reservasi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reservasi = tbl_reservasi::find($id);
        return view('admin.reservasi.edit', compact('reservasi'));
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
        $request->validate($this->rules, $this->message);

        $reservasi = tbl_reservasi::find($id);
        
        if ($bag = $request->get('kamar_terpilih')) {

            $pembayaran = 0;

            $reservasi->kamar()->sync( array_keys($bag) );

            foreach ($bag as $id_kamar => $jumlah_kamar) {
                
                $kamar = $reservasi->kamar()->find($id_kamar);
                
                if ($kamar) {

                    $pivot = $kamar->pivot; // Pivot = Tabel perantara

                    if ($jumlah_kamar != $pivot->jumlah_kamar) {

                        $kamar->jumlah_kamar += $pivot->jumlah_kamar - $jumlah_kamar;
                        $kamar->save();

                    }

                    $subtotal = $kamar->harga * $jumlah_kamar;
                    $pivot->update( compact('subtotal') );


                } else {
                    $kamar = tbl_kamar::find($id_kamar);

                    $kamar->jumlah_kamar -= $jumlah_kamar;
                    $kamar->save();

                    $subtotal = $kamar->harga * $jumlah_kamar;

                    $reservasi->kamar()->attach($id_kamar, compact('jumlah_kamar', 'subtotal'));
                }

                $pembayaran += $subtotal;
                
            }

            $reservasi->update( compact('pembayaran') );

        }

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservasi = tbl_reservasi::find($id);
        $reservasi->delete();

        return redirect()->route('admin.reservasi.index')->with('success', 'Reservasi telah dihapus');
    }

    public function check_in ($id) {
        $reservasi = tbl_reservasi::find($id);

        If ( !$reservasi->kamar()->exists() ) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Harus memilih kamar terlebih dahulu!');
        }

        if (!$reservasi->payment()->exists()) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Reservasi Harus terbayar terlebih dahulu!');
        }

        if (!$reservasi->kode_kamar()->exists()) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Reservasi harus memilih kode kamar terlbih dahulu!');
        }

        $reservasi->update([
            'status' => 'Check In'
        ]);

        return redirect()->route('admin.reservasi.index')->with('success', 'Check In Berhasil!');
    }

    public function payment ($id) {
        $reservasi = tbl_reservasi::find($id);

        If ( !$reservasi->kamar()->exist() ) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Harus memilih kamar terlebih dahulu!');
        }

        if (!$reservasi->kode_kamar()->exists()) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Reservasi harus memilih kode kamar terlbih dahulu!');
        }

        $reservasi->pembayaran()->create([
            "pembayaran" => $reservasi->pembayaran
        ]);

        return redirect()->route('admin.reservasi.index')->with('success', 'Payment Berhasil!');
    }

    public function check_in_and_payment ($id) {

        $reservasi = tbl_reservasi::find($id);

        If ( $reservasi->kamar()->first() ) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Harus memilih kamar terlebih dahulu!');
        }
        
        if (!$reservasi->kode_kamar()->exists()) {
            return redirect()->route('admin.reservasi.index')->with('failed', 'Reservasi harus memilih kode kamar terlbih dahulu!');
        }

        $this->payment($id);

        $this->check_in($id);

        return redirect()->route('admin.reservasi.index')->with('success', 'Check In dan Payment Berhasil!');
    }

    public function batalkan ($id) {
        $reservasi = tbl_reservasi::find($id);

        $reservasi->update([
            "status" => "Dibatalkan"
        ]);

        return redirect()->back()->with('success', 'Reservasi berhasil di batalkan!');
    }

    public function pilih_kode_kamar (Request $request, $id) {

        $request->validate([
            "pilih_kode_kamar.*.*" => 'required|distinct'
        ], [
            "pilih_kode_kamar.*.*.required" => "Pilih kamar tidak Ter isi semua!",
            "pilih_kode_kamar.*.*.distinct" => "Salah satu Pilih kamar tidak boleh sama!",
        ]);

        $reservasi = tbl_reservasi::find($id);

        if ($reservasi->kode_kamar()->first()) {

            $reservasi->kode_kamar()->update([
                "terisi" => false
            ]);

            foreach ($reservasi->kode_kamar as $kode_kamar_model) {
                $kode_kamar_model->reservasi()->dissociate();
                $kode_kamar_model->save();
            }


        }



        foreach ( $request->get('pilih_kode_kamar') as $id_kamar => $id_kode_kamar ) {
                
            $kamar = tbl_kamar::find($id_kamar);
            
            foreach ($id_kode_kamar as $id_kode) {
                $kode_kamar_model = $kamar->kode_kamar()->find($id_kode);

                $kode_kamar_model->reservasi()->associate($reservasi);

                $kode_kamar_model->terisi = true;
                $kode_kamar_model->save();

            }


        }


        return redirect()->route('admin.reservasi.index')->with('success', 'Pilih Kamar Berhasil');

    }

}
