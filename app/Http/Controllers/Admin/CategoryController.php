<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (request()->has('category')) {
            $categories = Category::where('name', 'like', '%' . request()->category . '%')->orderBy('id', 'desc')->paginate(10);
        } else {
            $categories = Category::where('name', 'like', '%' . request()->q . '%')->with('parent')->orderByDesc('id')->paginate(10);
        }
        // $categories = Category::with('parent')->orderByDesc('id')->paginate(5);
        return view('admin.categories.index', compact('categories'));
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
        return view('admin.categories.create', compact('categories'));
        // return redirect()->route('admin.categories.index')->with('msg', 'Category deleted successfully')->with('type', 'success');
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
            'image'   => 'required',
            'parent_id' => 'nullable|exists:categories,id', // null or Values
        ]);
        // uploads file

        // $img = $request->file('image');
        // $img_name = $img->getClientOriginalName();
        // $img->move(public_path('uploads/categories'), $img_name);

        $img_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('uploads/categories'), $img_name);


        // convert name to json

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        // Insert To DataBase

        Category::create([
            'name' => $name,
            // 'name' => $request->name_en . ' ' . $request->name_ar,
            'image' =>  $img_name,
            'parent_id' => $request->parent_id,
        ]);

        //Redirect

        return redirect()->route('admin.categories.index')->with('msg', 'Category create successfully')->with('type', 'success');
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
        // $categories = Category::all();
        // return view('admin.categories.show', compact('categories'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::all();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('categories', 'category'));
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
        //validate Data

        $request->validate([
            'name_en' => 'required',
            'name_ar' => 'required',
            'parent_id' => 'nullable|exists:categories,id', // null or Values
        ]);
        // uploads file

        // $img = $request->file('image');
        // $img_name = $img->getClientOriginalName();
        // $img->move(public_path('uploads/categories'), $img_name);
        $category = Category::findOrFail($id);

        $img_name = $category->image;

        if ($request->hasFile('image')) {
            $img_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('uploads/categories'), $img_name);
        }

        // convert name to json

        $name = json_encode([
            'en' => $request->name_en,
            'ar' => $request->name_ar,
        ], JSON_UNESCAPED_UNICODE);

        // Insert To DataBase

        $category->update([
            // 'name' => $request->name_en . ' ' . $request->name_ar,
            'name' => $name,
            'image' =>  $img_name,
            'parent_id' => $request->parent_id,
        ]);

        //Redirect

        return redirect()->route('admin.categories.index')->with('msg', 'Category create successfully')->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        //    Category::destroy($id);
        $category = Category::findOrFail($id);
        File::delete(public_path('uploads/categories/' . $category->image));
        //  Category::where('parent_id', $category->id)->update(['parent_id' => null]);
        $category->children()->update(['parent_id' => null]);
        $category->delete();
        //   return redirect()->route('admin.categories.index')->with('fail', 'Category deleted successfully');
        return redirect()->route('admin.categories.index')->with('msg', 'Category delete successfully')->with('type', 'danger');
    }
}
