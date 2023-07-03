<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 't_pembelian';

    protected $fillable = [
        'no_transaksi',
        'tgl_pembelian',
        'suplier'
    ];
}
