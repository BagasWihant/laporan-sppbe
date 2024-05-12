<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanRab extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','from','to','isi','tambahan'
    ];
}
