<?php

namespace App\Http\Controllers;

use App\Models\tbl_fasilitas;
use App\Models\tbl_gambar;
use App\Models\tbl_kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate = 15;

        $banyak_kamar = tbl_kamar::paginate ( $paginate );

        if ($search = $request->get('search')) {
            $banyak_kamar = tbl_kamar::search( $search )->paginate( $paginate );
        }

        return view('admin.kamar.index', compact('banyak_kamar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $rules = [
        'nama' => 'required',
        'ukuran' => 'required',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'status' => 'required',
        'jumlah_kamar' => ['required', 'numeric']
    ];

    private $message = [
        "nama.required" => "Nama Kamar perlu di isi!",
        "harga.required" => "Harga perlu di isi!",
        "harga.numeric" => "Harga harus angka!",
        "deskripsi.required" => "Deskripsi perlu di isi!",
        "status.required" => "Status perlu di isi!",
        
        "ukuran.required" => "Ukuran perlu di isi!",
        "ukuran.numeric" => "Ukuran harus angka!",

        "jumlah_kamar.required" => "Jumlah Kamar perlu di isi!",
        "jumlah_kamar.numeric" => "Jumlah Kamar harus angka!",
    ];

    private function SaveKamarImageRequest (Request $request, string $key) {
        
        if ($request->hasFile($key)) {
            $name = time() . "_" . $request->file($key)->getClientOriginalName();
            Storage::putFileAs('public/kamar/', $request->file($key), $name);
        }

        return !empty($name) ? $name : null;
    }

    private function SaveKamarImageFile ($file) {
        
        $name = time() . "_" . $file->getClientOriginalName();
        Storage::putFileAs('public/kamar/', $file, $name);

        return !empty($name) ? $name : null;
    }

    private function DeleteKamarImage ($filename) {
        if (Storage::exists($path = 'kamar/' . $filename) and !empty($filename)) {
            Storage::delete($path);
        }
    }

    public function create () {
        $tbl_fasilitas = tbl_fasilitas::all();

        return view('admin.kamar.create', compact('tbl_fasilitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $request->validate($this->rules, $this->message);

        $kamar = tbl_kamar::create($request->except("gambar_utama"));

        if ($request->hasFile('gambar')) {

            foreach ($request->file('gambar') as $gambar) {
                $ImageName = $this->SaveKamarImageFile($gambar);
    
                $kamar->gambar()->create([
                    "gambar" => $ImageName
                ]);
    
            }
        
        }
        
        if ($request->hasFile('gambar_utama')) {

            $ImageName = $this->SaveKamarImageFile($request->file('gambar_utama'));

            $gambar_utama = $kamar->gambar()->create([
                "gambar" => $ImageName
            ]);

            $gambar_utama->gambar_utama = true;

            $gambar_utama->save();

        }

        if ($request->has('kode_kamar')) {

            foreach ($request->get('kode_kamar') as $kode) {

                $kamar->kode_kamar()->create([
                    'kode_kamar' => $kode
                ]);


            }
            

        }

        $kode_kamar_count = $kamar->kode_kamar->count();

        for ($i = $kode_kamar_count + 1; $i <= $request->get('jumlah_kamar'); $i++) {
            $kamar->kode_kamar()->create([
                'kode_kamar' => $kamar->nama . " " . $i
            ]);
        }

        $kamar->fasilitas()->attach($request->get('fasilitas'));

        $kamar->save();

        return redirect()->route('admin.kamar.index')->with('success', "Data kamar ditambahkan!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kamar = tbl_kamar::find($id);
        return view('admin.kamar.show', compact('kamar'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tbl_fasilitas = tbl_fasilitas::all();
        $kamar = tbl_kamar::find($id);
        return view('admin.kamar.edit', compact('kamar', 'tbl_fasilitas'));
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

        $kamar = tbl_kamar::find($id);

        $data = $request->all();

        if ($request->hasFile('gambar')) {

            foreach ($request->file('gambar') as $gambar) {
                $ImageName = $this->SaveKamarImageFile($gambar);

                $kamar->gambar()->create([
                    "gambar" => $ImageName
                ]);

            }

        }

        if ($request->hasFile('gambar_utama')) {

            $gambar_utama = $kamar->gambar_utama();

            if ($request->get('delete_image_data'))
                $this->DeleteKamarImage($gambar_utama->gambar);

            $ImageName = $this->SaveKamarImageFile($request->file('gambar_utama'));
            
            if ($gambar_utama) {

                $gambar_utama->update([
                    "gambar" => $ImageName
                ]);

            } else {

                $kamar->gambar()->create([
                    "gambar" => $ImageName,
                    "gambar_utama" => true
                ]);

            }
           

        }

        if ($request->has('delete_image')) {

            foreach ($request->get('delete_image') as $value) {
                $gambar = tbl_gambar::find($value);

                if ($request->get('delete_image_data'))
                    $this->DeleteKamarImage($gambar->gambar);

                $gambar->delete();
            }

        }

        $kamar->fasilitas()->sync($request->get('fasilitas'));

        if ($request->has('kode_kamar')) {

            foreach ($request->get('kode_kamar') as $kode) {
                
                if ($kode) {
                    $kamar->kode_kamar()->create([
                        'kode_kamar' => $kode
                    ]);
                }
                


            }
            
        }

        if ($request->has('kode_kamar_model')) {

            $kode_kamar_id = array_keys( $request->get('kode_kamar_model') );
            $detach = $kamar->kode_kamar()->pluck('id')->diff( $kode_kamar_id );

            foreach ($detach as $key) {
                $item = $kamar->kode_kamar()->find($key);
                if ($item) $item->delete();
            }

            foreach ($request->get('kode_kamar_model') as $key => $value) {
                $kode_kamar = $kamar->kode_kamar()->find($key);
                if ($kode_kamar->kode_kamar != $value) {
                    $kode_kamar->update([
                        "kode_kamar" => $value
                    ]);
                }
            }

        } else {
            foreach ($kamar->kode_kamar as $kode_kamar) {
                $kode_kamar->delete();
            }
        }

        $kode_kamar_count = $kamar->kode_kamar->count();

        for ($i = $kode_kamar_count + 1; $i <= $request->get('jumlah_kamar'); $i++) {
            $kamar->kode_kamar()->create([
                'kode_kamar' => $kamar->nama . " " . $i
            ]);
        }

        
        
        $kamar->update($data);

        return redirect()->route('admin.kamar.index')->with('success', "Data kamar Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {

        $kamar = tbl_kamar::find($id);
                    
        //Delete Gambar Kamar if cheked
        if ($request->get("delete_image_data")) {
            foreach ($kamar->gambar as $gambar) {
                $this->DeleteKamarImage($gambar->gambar);
                $gambar->delete();
            }
        }

        $kamar->delete();

        return redirect()->route('admin.kamar.index')->with('success', "Data kamar terhapus!");
    }
}
