<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mbarang extends Model
{
    use HasFactory;
    protected $table = 'm_barang';

    protected $fillable = [
        'nm_barang',
        'wr_barang',
        'stok_barang',
        'foto_barang',
        'satuan',
        'harga',
        'total',
    ];



}
