<?php

namespace App\Http\Controllers;

use App\Models\tbl_gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    private function SaveGalleryImageRequest (Request $request, string $key) {
        
        if ($request->hasFile($key)) {
            $name = time() . "_" . $request->file($key)->getClientOriginalName();
            Storage::putFileAs('public/gallery/', $request->file($key), $name);
        }

        return !empty($name) ? $name : null;
    }

    private function SaveGalleryImageFile ($file) {
        
        $name = time() . "_" . $file->getClientOriginalName();
        Storage::putFileAs('public/gallery/', $file, $name);

        return !empty($name) ? $name : null;
    }

    private function DeleteGalleryImage ($filename) {
        if (Storage::exists($path = 'public/gallery/' . $filename) and !empty($filename)) {
            Storage::delete($path);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery_list = tbl_gallery::all('gallery')->unique();
        $gallery_image = tbl_gallery::all(["id", "gambar"]);
        return view('admin.gallery.index', compact('gallery_list', 'gallery_image'));
    }

    /**
     * Update or Create new resouce
     *
     * @return \Illuminate\Http\Response
     */

    public function save (Request $request) {
        

        if ($value = $request->get('delete_image')) {
            foreach ($value as $gambar_id) {
                $gambar = tbl_gallery::find($gambar_id);

                if ($request->get('delete_data_image')) {
                    $this->DeleteGalleryImage( $gambar->gambar );
                }

                $gambar->delete();
            }
        }

        if ($files = $request->file('gambar')) {

            foreach ($files as $gallery => $file) {

                foreach ($file as $value) {
                    $image_name = $this->SaveGalleryImageFile($value);

                    tbl_gallery::create([
                        "gallery" => $gallery,
                        "gambar" => $image_name
                    ]);


                }


            }
        }

        return redirect()->back()->with('success', 'Data telah disimpan');

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