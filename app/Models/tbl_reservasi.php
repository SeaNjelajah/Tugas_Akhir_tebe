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
        return $this->belongsToMany(tbl_kamar::class, 'tbl_hubungan_kamar_reservasi');
    }

    public function daftar_tamu () {
        return $this->kamar()->where('status', 'Check In')->get();
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

}
