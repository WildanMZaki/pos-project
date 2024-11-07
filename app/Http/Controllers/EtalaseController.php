<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class EtalaseController extends Controller
{
    public function index()
    {
        $data['products'] = Product::where('active', true)->get();

        return view('menu.etalase.index', $data);
    }
}
