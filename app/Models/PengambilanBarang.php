<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengambilanBarang extends Model
{
    use HasFactory;
    protected $table = 't_pengambilan_barang';

    protected $fillable = [
        'barang_id',
        'qty',
        'no_transaksi',
    ];

    public function pengambilan()
    {
        return $this->HasMany(Pengambilan::class,'no_transaksi', 'no_transaksi');
    }

    public function barang()
    {
        return $this->HasMany(Mbarang::class,'id', 'barang_id');
    }


}
