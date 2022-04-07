<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class tbl_rincian_hubungan_kamar_reservasi extends Pivot {

    protected $table = 'tbl_rincian_hubungan_kamar_reservasi';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    protected $guarded = ['id'];

    public $timestamps = true;
    
}
