<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::with('category')->orderByDesc('id')->paginate(10);
        if (request()->has('product')) {
            $products = Product::where('name', 'like', '%' . request()->product . '%')->orderBy('id', 'desc')->paginate(10);
        } else {
            $products = Product::where('name', 'like', '%' . request()->product . '%')->with('category')->orderByDesc('id')->paginate(10);
        }

        // $products = Product::where('name', 'like', '%' . request()->q . '%')->with('category')->orderByDesc('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $product = new Product();
        return view('admin.products.create', compact('categories', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate Data
        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'image' => 'required',
            'content_en' => 'required',
            'content_ar' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
        ]);

        $img_name = rand() . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/products'), $img_name);

         // convert name  and content to json
         $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        $content = json_encode([
            'en' => $request->content_en,
            'ar' => $request->content_ar,
        ], JSON_UNESCAPED_UNICODE);


        $product = Product::create([
            'name' => $name,
            'image' => $img_name,
            'content' => $content,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);

        // uploads album to image table if exists

        if($request->has('album')){
            foreach($request->album as $item){
                $img_name = rand() . $item->getClientOriginalName();
                $item->move(public_path('uploads/products'), $img_name);
                Image::create([
                    'path' => $img_name,
                    'product_id' => $product->id,
                ]);
            }
        }

        // redirect

        return redirect()->route('admin.products.index')->with('msg', 'Products create successfully')->with('type', 'success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
