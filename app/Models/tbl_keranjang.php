<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_keranjang extends Model {

    use HasFactory;

    protected $table = "tbl_keranjang";

    protected $guarded = ['id'];

    public function kamar () {
        return $this->belongsTo(tbl_kamar::class, 'id_kamar');
    }

}
