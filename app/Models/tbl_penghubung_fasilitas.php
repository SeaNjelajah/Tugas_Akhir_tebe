<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_penghubung_fasilitas extends Model
{
    use HasFactory;
    protected $table = "tbl_penghubung_fasilitas";

    protected $guarded = [];
    public $timestamps = false;
}
