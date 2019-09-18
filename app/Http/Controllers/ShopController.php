<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);
        return view('shop.view', [
            'products' => $products
        ]);
    }

    public function buy(Request $request, Product $product)
    {
        dd($product);
    }
}
