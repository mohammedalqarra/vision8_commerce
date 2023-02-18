<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function add_to_cart(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'quantity'  => 'gt:0',
            'product_id' => 'exists:products,id'
        ]);


        $product = Product::find($request->product_id);


        Cart::updateOrCreate([
            'product_id' => $request->product_id,
            'user_id' => Auth::id(),
        ], [

            'price' => $product->sale_price ? $product->sale_price : $product->price,
            'quantity' => DB::raw('quantity  + ' . $request->quantity),
        ]);

        return redirect()->back()->with('msg', 'product added to cart successfully');
    }
}
