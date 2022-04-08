<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_pembayaran extends Model
{
    use HasFactory;

    protected $table = "tbl_pembayaran";

    protected $guarded = ["id"];

    const CREATED_AT = "pada_tanggal";

    const UPDATED_AT = null;
   
}
