<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_gambar extends Model
{
    use HasFactory;

    protected $table = "tbl_gambar";

    protected $guarded = ["id"];
}
