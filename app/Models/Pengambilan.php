<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengambilan extends Model
{
    use HasFactory;
    protected $table = 't_pengambilan';

    protected $fillable = [
        'no_transaksi',
        'tgl_pengambilan',
        'suplier'
    ];


}
