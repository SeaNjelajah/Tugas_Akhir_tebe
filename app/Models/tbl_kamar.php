<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class tbl_kamar extends Model 
{
    use HasFactory, Searchable, SoftDeletes;
    
    protected $table = "tbl_kamar";

    protected $guarded = ["id"];

    public function fasilitas() {
        return $this->belongsToMany(tbl_fasilitas::class, 'tbl_penghubung_fasilitas');
    }

    public function reservasi() {
        $this->belongsToMany(tbl_reservasi::class, 'tbl_rincian_hubungan_kamar_reservasi');
    }

    public function gambar () {
        return $this->hasMany(tbl_gambar::class, 'id_kamar');
    }

    public function gambar_utama () {
        return $this->gambar()->where('gambar_utama', true)->first();
    }

    public function ulasan () {
        return $this->hasMany(tbl_ulasan::class, 'id_kamar');
    }

    public function kode_kamar () {
        return $this->hasMany(tbl_kode_kamar::class, 'id_kamar');
    }

    

}
