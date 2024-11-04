<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'supplier',
        'note'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
