<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class tbl_fasilitas extends Model
{
    use HasFactory, Searchable;

    protected $table = "tbl_fasilitas";

    protected $guarded = ["id"];

    public function kamar () {
        return $this->belongsToMany(tbl_kamar::class, 'tbl_penghubung_fasilitas');
    }
}
