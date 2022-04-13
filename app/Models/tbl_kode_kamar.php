<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_kode_kamar extends Model
{
    use HasFactory;

    protected $table = "tbl_kode_kamar";

    public $incrementing = true;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function kamar () {
        return $this->belongsTo(tbl_kamar::class, 'id_kamar');
    }
    
    public function reservasi () {
        return $this->belongsTo(tbl_reservasi::class, 'id_reservasi');
    }


}
