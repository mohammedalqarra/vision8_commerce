<?php

namespace App\Http\Controllers;

use App\Models\Review;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    //
    public function index()
    {
        $products_slider =  product::orderByDesc('id')->take(3)->get();

        $categories =  Category::orderByDesc('id')->take(3)->get();

        $products_latest =  product::orderByDesc('id')->take(9)->offset(3)->get();

        return view('site.index' , compact('categories' , 'products_slider' , 'products_latest'));
    }

    public function about()
    {

        return view('site.about');
    }

    public function shop()
    {
        $products = Product::orderBy('id' , 'Desc')->paginate(6);
       //  $category = '' ;
        return view('site.shop' , compact('products'));
    }

    public function category($id)
    {

        $category = Category::FindOrFail($id);

        $products = $category->product()->orderByDesc('id')->paginate(6);

        return view('site.shop' , compact('products' , 'category'));
    }

    public function contact()
    {
        return view('site.contact');
    }


    public function search(Request $request)
    {
        $products = Product::where('name' , 'like' , '%' . $request->search . '%')->orderByDesc('id')->paginate(6);

        return view('site.search' , compact('products'));
    }

    public function product($slug)
    {
        $product = Product::where('slug' , $slug)->first();

        if(!$product){
            abort(404);
        }

        $next  = Product::where('id' , '>' , $product->id)->first();
        $prev  = Product::where('id' , '<' , $product->id)->orderByDesc('id')->first();
        $related = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();

        return view('site.product' , compact('product' , 'next' , 'prev' , 'related'));
    }

    public function product_review(Request $request)
    {
        // dd($request->all);
        review::create([
            'comment' => $request->comment,
            'star' => $request->rating,
            'product_id' => $request->product_id,
            'user_id'  => Auth::id(),
        ]);

        return redirect()->back();
    }
}
