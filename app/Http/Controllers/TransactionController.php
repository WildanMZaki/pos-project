<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('menu.transaksi.index');
    }

    public function create()
    {
        $selected_products = TransactionDetail::whereNull('transaction_id')->where('user_id', auth()->id())->get();
        $selected_product_ids = [];
        foreach ($selected_products as $trx_detail) {
            $selected_product_ids[] = $trx_detail->product_id;
        }
        $data['products'] = Product::where('active', true)->whereNotIn('id', $selected_product_ids)->get();
        $data['selected_products'] = $selected_products;
        return view('menu.transaksi.create', $data);
    }

    public function store_products(Request $request)
    {
        $transaction_details_items = [];
        foreach ($request->products as $product_id) {
            $product = Product::find($product_id);
            $belanja_terakhir = $product->purchases()->latest()->first();
            $fund = $belanja_terakhir->price / $belanja_terakhir->qty;

            if (!empty($product)) {
                $transaction_details_items[] = [
                    'user_id' => auth()->id(),
                    'product_id' => $product_id,
                    'fund' => $fund,
                    'qty' => 1,
                    'price' => $product->price,
                    'total' => 1 * $product->price,
                    'created_at' => now(),
                ];
            }
        }

        if (!empty($transaction_details_items)) {
            TransactionDetail::insert($transaction_details_items);
        }

        return redirect('transaksi/buat-baru');
    }
}
