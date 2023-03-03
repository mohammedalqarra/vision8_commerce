<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Str;
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
        $products = Product::all();

        if ($products->count() > 0) {
            return response()->json([
                'message' => 'All Products',
                'status' => 'Success',
                'data' => $products,
            ], 200); // status
        } else {
            return response()->json([
                'message' => 'No Data Found',
                'status' => 'Success',
                'data' => [],
            ], 200); // status
        }
        // return [
        //     'data' => $products,
        //     'message' => 'All Products',
        //     'status' => 'Success',
        // ];
        // return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        //    $img = $request->file('image');
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

        // Insert To DataBase

        $slugCount = Product::where('slug', 'like', '%' . Str::slug($request->name_en) . '%')->count();

        $slug = Str::Slug($request->name_en);

        if ($slugCount) {
            $slug = Str::Slug($request->name_en) . '_' . $slugCount;
        }

        $product = Product::create([
            'name' => $name,
            'slug' => $slug,
            // 'slug' => Str::slug($request->name_en),
            //  'slug' => Str::slug($request->name_en).rand(), // لما بدي اضيف أي منتج نفس الأسم بس ال id  تختلف
            'image' => $img_name,
            'content' => $content,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
        ]);


        // uploads Album to images table if exists
        if ($request->has('album')) {
            foreach ($request->album as $item) {
                $img_name = rand() . $item->getClientOriginalName();
                $item->move(public_path('uploads/products'), $img_name);
                Image::create([
                    'path' => $img_name,
                    'product_id' => $product->id,
                ]);
            }
        }

        return $product;
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
        $product = Product::find($id);

        if($product){
            return response()->json([
                'message' => 'Found Data',
                'status' => 'Success',
                'data' => $product,
            ], 200); // status
        }else {
            return response()->json([
                'message' => 'No Found Data',
                'status' => 'Success',
                'data' => [],
            ], 404); // status
        }

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
        $product = Product::findOrFail($id);
        $data = $request->all();
        // Uploads the files
        $img_name = $product->image;
        if ($request->hasFile('image')) {
            $img_name = rand() . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/products'), $img_name);
            $data['image'] = $img_name;
        }

        if ($request->has('name_en')) {
            $name = json_encode([
                'en' => $request->name_en,
                'ar' => $product->name_ar,
            ], JSON_UNESCAPED_UNICODE);
        }

        if ($request->has('name_ar')) {
            $name = json_encode([
                'en' => $product->name_en,
                'ar' => $request->name_ar,
            ], JSON_UNESCAPED_UNICODE);
        }

        if ($request->has('content_en')) {
            $content = json_encode([
                'en' => $request->content_en,
                'ar' => $product->content_ar,
            ], JSON_UNESCAPED_UNICODE);
        }

        if ($request->has('content_ar')) {
            $content = json_encode([
                'en' => $product->content_en,
                'ar' => $request->content_ar,
            ], JSON_UNESCAPED_UNICODE);
        }

        // Store Data To Data base

        if ($request->has('name_en') || $request->has('name_ar')) {
            $data['name'] = $name;
            unset($data['name_en']);
            unset($data['name_ar']);
        }

        if ($request->has('content_en') || $request->has('content_ar')) {
            $data['content'] = $content;
            unset($data['content_en']);
            unset($data['content_ar']);
        }

        // return $data;
        // exit;


        return $product->update($data);


        // $product->update([
        //     'name' => $name,
        //     'image' => $img_name,
        //     'content' => $content,
        //     'price' => $request->price,
        //     'sale_price' => $request->sale_price,
        //     'quantity' => $request->quantity,
        //     'category_id' => $request->category_id,
        // ]);


        // uploads Album to images table if exists
        // if ($request->has('album')) {
        //     foreach ($request->album as $item) {
        //         $img_name = rand() . $item->getClientOriginalName();
        //         $item->move(public_path('uploads/products'), $img_name);
        //         Image::create([
        //             'path' => $img_name,
        //             'product_id' => $product->id,
        //         ]);
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return 'Delete ' . $id;
        return Product::destroy($id);
    }
}
