<?php

namespace App\Models;

use Database\Factories\ReservasiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_reservasi extends Model
{
    use HasFactory;
    
    protected $table = "tbl_reservasi";

    protected $guarded = ['id'];
    
    public function kamar () {
        return $this->belongsToMany(tbl_kamar::class, 'tbl_rincian_hubungan_kamar_reservasi')->withPivot(['jumlah_kamar', 'subtotal'])->withTimestamps();
    }

    public function rincian() {
        return $this->kamar()->pivot;
    }


    public function kode_kamar () {
        return $this->hasMany(tbl_kode_kamar::class, 'id_reservasi');
    }

    public function check_in () {
        return $this->hasOne(tbl_konfirmasi_checkin::class, 'id_reservasi');
    }

    public function check_out () {
        return $this->hasOne(tbl_konfirmasi_checkout::class, 'id_reservasi');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ReservasiFactory::new();
    }

    public static function pabrik($jumlah = 10) {
        return (tbl_reservasi::count() == 0 ) ? 
        tbl_reservasi::factory()->count($jumlah)->create() : 
        tbl_reservasi::all();
    }

    public function pembayaran () {
        return $this->hasOne(tbl_pembayaran::class, 'id_reservasi');
    }

}
