<?php

namespace App\Http\Controllers;

use App\Models\tbl_contact_message;
use App\Models\tbl_gallery;
use App\Models\tbl_kamar;
use App\Models\tbl_keranjang;
use App\Models\tbl_reservasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    public function home () {

        $this->purgeKeranjang();

        $keranjang = [];

        if ($id_cart = session()->get('id_cart')) {
            $keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%")->get();
        }

        $gallery_image = tbl_gallery::all('gambar', 'gallery');
        $gallery_list = $gallery_image->pluck('gallery')->unique();

        return view('home', compact('keranjang', 'gallery_image', 'gallery_list'));
    }

    public function pengantar () {
        return view('introduction');
    }

    public function gallery () {

        $gallery_image = tbl_gallery::all('gambar', 'gallery');
        $gallery_list = $gallery_image->pluck('gallery')->unique();

        return view('gallery', compact('gallery_list', 'gallery_image'));
    }

    public function contact () {
        return view('contact');
    }

    private function SessionSave (Request $request) {
        session()->put($request->except(['_token', '_method']));

    }

    private function Create_id_cart () {
        if (!session()->has('id_cart')) {

            session()->put([
                "id_cart" => $id_cart =  uniqid()
            ]);

            return $id_cart;

        }
    }

    private $rules = [
        "nama_tamu" => "required",
        "email" => "required|email",
        "no_tlp" => "required|numeric",
        "jumlah_k" => "required|numeric",
        "jumlah_d" => "required|numeric",
        "jumlah_a" => "required|numeric",
        "pesan_lain" => "required",
        "check_in" => "required|date",
        "check_out" => "required|date",
    ];

    private $message = [
        "nama_tamu.required" => "Nama Tamu perlu di isi!",

        "email.required" => "Email perlu di isi!",
        "email.email" => "Email perlu di isi!",

        "no_tlp.required" => "Nomor Telepon perlu di isi!",
        "no_tlp.numeric" => "Nomor Telepon harus angka!",



        "jumlah_d.required" => "Jumlah Dewasa perlu di isi!",
        "jumlah_d.numeric" => "Jumlah Dewasa harus angka!",

        "jumlah_a.required" => "Jumlah Anak - Anak perlu di isi!",
        "jumlah_a.numeric" => "Jumlah Anak - Anak harus angka!",

        "check_in.required" => "Tanggal Check In perlu di isi!",
        "check_in.date" => "Tanggal Check In harus tanggal!",

        "check_out.required" => "Tanggal Check Out perlu di isi!",
        "check_out.date" => "Tanggal Check Out harus tanggal",
    ];

    public function purgeKeranjang () {

        $keranjang = tbl_keranjang::where('created_at', '<=',  now()->subMinutes(15))->get();

        foreach ($keranjang as $item) {

            $kamar = $item->kamar()->first();
            $kamar->jumlah_kamar += $item->jumlah;
            $kamar->save();

            $item->delete();

        }
       
    }


    public function homeSubmit (Request $request) {

        $this->purgeKeranjang();

        $request->validate($this->rules, $this->message);

        
        if ( $request->get('pilih_kamar_checkbox') ) {

            $this->SessionSave($request);

            $this->Create_id_cart();

            return redirect()->route('kamar');
        }

        $rules = [
            "jumlah_k" => "required|numeric"
        ];

        $message = [
            "jumlah_k.required" => "Jumlah Kamar perlu di isi!",
            "jumlah_k.numeric" => "Jumlah Kamar harus angka!"
        ];

        $request->validate($rules, $message);


        return $this->selesai($request);

    }

    public function kamar_dan_biaya () {

        $this->purgeKeranjang();
        
        $banyak_kamar = tbl_kamar::where('jumlah_kamar', '>', '0')->get();
        
        if ($id_cart = session()->get('id_cart')) {
            foreach ( tbl_keranjang::where('id_cart', 'like', "%$id_cart%")->get() as $keranjang) {
                $banyak_kamar = $banyak_kamar->merge( $keranjang->kamar()->get() );
            }
        }

        return view('rooms-tariff', compact('banyak_kamar'));
    }

    public function detail_kamar ($id) {

        $this->purgeKeranjang();

        $kamar = tbl_kamar::find($id);
            
        $keranjang = [];

        if ($id_cart = session()->get('id_cart')) {
            $keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%")->get();
        } else if ($kamar->jumlah_kamar <= 0) {
            return redirect()->back()->withInput();
        }

        return view('room-details', compact('kamar', 'keranjang'));
    }

    public function kamar_keranjang (Request $request) {

        $this->purgeKeranjang();

        $request->validate([
            'kamar_terpilih' => ['required']
        ]);

        $this->Create_id_cart();

        


        foreach ($request->get('kamar_terpilih') as $key => $value) {

            $kamar = tbl_kamar::find($key);

            if ($value > $kamar->jumlah_kamar) {
                return redirect()->back()->withErrors(["jumlah_kamar" => "Jumlah Kamar Salah!"]);
            
            } else if ($value > 0) {

                $keranjang = tbl_keranjang::where('id_cart', session()->get('id_cart'))->where('id_kamar', $key)->first();

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
                        'jumlah' => $value,
                        'subtotal' => $kamar->harga * $value
                    ]);

                }
                

            } else {

                $keranjang = tbl_keranjang::where('id_kamar', $key)->first();

                $kamar->jumlah_kamar += $keranjang->jumlah;
                $kamar->save();

                $keranjang->delete();
            
            }


            
        }

        if ($bag = $request->get('hapus_terpilih')) {

            $keranjang = tbl_keranjang::where('id_cart', session()->get('id_cart'));

            foreach ($bag as $key) {
                $model = $keranjang->where('id_kamar', $key)->first();

                $kamar = $model->kamar()->first();
                $kamar->jumlah_kamar += $model->jumlah;
                $kamar->save();

                $model->delete();

            }

        }

        $keranjang = tbl_keranjang::where('id_cart', session()->get('id_cart'));

        session()->put("jumlah_k", $keranjang->sum('jumlah'));


        return redirect()->back();
    }

    public function selesai (Request $request) {

        do {
            $qrcode = Str::random(10);
            $qrcode = Str::upper($qrcode);
        } while (tbl_reservasi::where('qrcode', 'like', "%$qrcode%")->first());

        if (session()->has('id_cart')) {


            Validator::make( session()->all(), $this->rules, $this->message )->validate();
            
            $durasi = Carbon::create( session()->get('check_in') )->diffInDays(Carbon::create( session()->get('check_out') ));
            
            $data = session()->all();

            $data = array_merge( $data, compact('qrcode', 'durasi') );

            $reservasi = tbl_reservasi::create( $data );

            $id_cart = session()->get('id_cart');

            $keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%")->get();

            $pembayaran = $keranjang->sum('subtotal');

            $reservasi->update( compact('pembayaran') );

            foreach ($keranjang as $item) {

                $reservasi->kamar()->attach(
                    $item->id_kamar, ["jumlah_kamar" => $item->jumlah, 'subtotal' => $item->subtotal]
                );

                $item->delete();

            }
            
        } else {

            $durasi = Carbon::create( $request->check_in )->diffInDays(Carbon::create( $request->check_out ));

            $reservasi = tbl_reservasi::create ( array_merge($request->all(), compact('qrcode', 'durasi')) );

        }
        
        session()->invalidate();

        return view('selesai', compact('reservasi'));

    }


    public function ulang () {

        $this->purgeKeranjang();

        if ($id_cart = session()->get('id_cart')) {
            $keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%");

            foreach ($keranjang as $item) {
                $kamar = $item->kamar()->first();
                $kamar->jumlah_kamar += $item->jumlah;
                $kamar->save();

                $item->delete();
            }

        }

        session()->invalidate();

        return redirect()->back();
    }


    public function KamarSubmit (Request $request) {

        $this->purgeKeranjang();

        $request->validate($this->rules, $this->message);

        $this->SessionSave($request);

        $id_cart = $this->Create_id_cart();

        if ( $request->get('pilih_kamar_checkbox') ) {
            return redirect()->route('kamar');
        }

        $rules = [
            "jumlah_k" => "required|numeric",
            'id_kamar' => 'required|numeric'
        ];

        $message = [
            "jumlah_k.required" => "Jumlah Kamar perlu di isi!",
            "jumlah_k.numeric" => "Jumlah Kamar harus angka!"
        ];

        $request->validate($rules, $message);

        $kamar = tbl_kamar::find( $id_kamar = $request->get('id_kamar') );

        if ($keranjang = tbl_keranjang::where('id_cart', 'like', "%$id_cart%")
            ->where('id_kamar', $id_kamar)->first()) {

            $kamar->jumlah_kamar += $keranjang->jumlah - $request->get('jumlah_k');
            $kamar->save();

            $keranjang->jumlah = $request->get('jumlah_k');
            $keranjang->save();
        
        } else {
            if ($request->get('jumlah_k') > $kamar->jumlah_kamar) {
                $jumlah = $kamar->jumlah_kamar;

            } else if ($request->get('jumlah_k') > 0) {

                tbl_keranjang::create([
                    "id_cart" => session()->get('id_cart'),
                    'id_kamar' => $kamar->id,
                    'jumlah' => $jumlah = $request->get('jumlah_k'),
                    "subtotal" => $jumlah * $kamar->harga
                ]);
    
                $kamar->jumlah_kamar -= $jumlah;
                $kamar->save();

            }
            
        }

        return redirect()->route('kamar.detail', $kamar->id);
    }


    public function contact_save (Request $request) {

        $request->validate([
            "nama" => "required",
            "email" => "email",
            "phone" => "required",
            "pesan" => "required"
        ]);

        tbl_contact_message::create( $request->all() );

        return redirect()->route('contact')->with('success', true);
    }
    

    
}
