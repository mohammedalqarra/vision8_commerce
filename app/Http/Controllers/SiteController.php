<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index()
    {
        $products_slider = Product::orderBy('id' , 'desc')->take(3)->get();

        $categories  = Category::orderBy('id' , 'desc')->take(3)->get();

        return view('site.index' , compact('categories' , 'products_slider'));
    }

    public function about()
    {
        return view('site.about');
    }

    public function shop()
    {
        return view('site.shop');
    }

    public function category($id)
    {
        return view('site.index');
    }

    public function contact()
    {
        return view('site.contact');
    }



}
