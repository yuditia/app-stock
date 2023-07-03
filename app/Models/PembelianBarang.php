<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianBarang extends Model
{
    use HasFactory;
    protected $table = 't_pembelian_barang';

    protected $fillable = [
        'barang_id',
        'qty',
        'no_transaksi',
    ];

    public function pembelian()
    {
        return $this->HasMany(Pembelian::class,'no_transaksi', 'no_transaksi');
    }

    public function barang()
    {
        return $this->HasMany(Mbarang::class,'id', 'barang_id');
    }
}
