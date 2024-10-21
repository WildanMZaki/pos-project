<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    // Defaultnya: nyambung ke tabel barangs
    // Di sini didefinisikan secara manual agar nyambung/terhubung ke tabel producst
    protected $table = 'products';
}
