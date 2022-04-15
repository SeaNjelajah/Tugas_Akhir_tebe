<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_contact_message extends Model
{
    use HasFactory;
    
    protected $table = "tbl_contact_message";
    protected $guarded = ["id"];

    const UPDATED_AT = null;
}
