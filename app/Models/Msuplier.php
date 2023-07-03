<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Msuplier extends Model
{
    use HasFactory;
    protected $table = 'm_suplier';

    protected $fillable = [
        'nm_suplier',
    ];
}
