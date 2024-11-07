<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // nyambung ke table: products


    # merelasikan tabel products ke table purchases
    public function purchases() // (Pembelian)
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }

    public function sold() // (Penjualan)
    {
        return $this->hasMany(TransactionDetail::class, 'product_id');
    }

    // Accessor (Pembuatan kolom sintesis (tiruan))
    public function getStokAttribute()
    {
        $stok = $this->purchases()->sum('qty') - $this->sold()->sum('qty');
        return $stok;
    }
}
