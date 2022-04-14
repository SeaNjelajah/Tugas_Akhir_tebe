<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_konfirmasi_checkout extends Model
{
    use HasFactory;
    
    protected $table = "tbl_konfirmasi_checkout";

    protected $guarded = [];

    public $incrementing = false;

    const UPDATED_AT = null;
}
