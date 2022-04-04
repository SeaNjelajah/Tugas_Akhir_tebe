<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_kamar extends Model
{
    use HasFactory;
    protected $table = "tbl_kamar";

    protected $guarded = ["id"];

    public function fasilitas() {
        return $this->belongsToMany(tbl_fasilitas::class, 'tbl_penghubung_fasilitas');
    }

    public function gambar () {
        return $this->hasMany(tbl_gambar::class, 'id_kamar');
    }

    public function gambar_utama () {
        return $this->gambar()->where('gambar_utama', true)->first();
    }

}
