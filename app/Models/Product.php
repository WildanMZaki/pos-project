<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // nyambung ke table: products


    # merelasikan tabel products ke table purchases
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'product_id');
    }
}
