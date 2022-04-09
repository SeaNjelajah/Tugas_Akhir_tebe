<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_ulasan extends Model
{
    use HasFactory;

    protected $table = "tbl_ulasan";

    protected $guarded = ['id'];

    
}
