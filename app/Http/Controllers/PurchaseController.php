<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $data['purchases'] = Purchase::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('menu.purchases.index', $data);
    }

    public function create()
    {
        $data['products'] = Product::where('active', true)->orderBy('name', 'ASC')->get();
        return view('menu.purchases.create', $data);
    }

    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $qty = $request->qty;
        $price = $request->price;
        $supplier = $request->supplier;
        $note = $request->note;

        Purchase::create([
            'product_id' => $product_id,
            'qty' => $qty,
            'price' => $price,
            'supplier' => $supplier,
            'note' => $note,
        ]);

        return redirect('/purchases');
    }
}
