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

    public function cart()
    {
        return view('site.cart');
    }

    public function update_cart(Request $request)
    {
        foreach ($request->qyt as $product_id => $new_qyt) {
            Cart::where('product_id', $product_id)
                ->where('user_id', Auth::id())
                ->update(['quantity' => $new_qyt]);
        }

        return redirect()->back();
    }

    public function remove_cart($id)
    {
        Cart::destroy($id);

        return redirect()->back();
    }

    public function checkout()
    {
        $total = Auth::user()->carts()->sum(DB::raw('price * quantity'));

        if ($total == 0) {

            return redirect()->route('site.shop');
        }

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=$total" .
            "&currency=USD" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
        ));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        //    return $responseData;
        $responseData = json_decode($responseData, true); // array associative
        $id = $responseData['id'];

        return view('site.checkout', compact('id'));
    }

    public function payment(Request $request)
    {
        $responseData = $request->resourcePath;

        $url = "https://eu-test.oppwa.com$responseData";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
        ));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
       // return $responseData;

        $responseData = json_decode($responseData , true);

        // code "000.100.110"

        $code = $responseData['result']['code'];

        if($code  == '000.100.110'){
            $amount = $responseData['amount'];
            $transaction_id = $responseData['id'];

            echo 'Done';
        }else{
            echo 'Fail';
        }


    }
}
