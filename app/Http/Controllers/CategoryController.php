<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $is_active = "category_list";
       $data    = Category ::get();
       return view('category.list',compact('data','is_active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $is_active = "create_category";
        return view('category.create',compact('is_active'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'           => 'required|string|max:255',
            'slug'            => 'required|string|max:255|unique:categories,slug', 
            'meta_title'      => 'nullable|string|max:255',
            'meta_keywords'   => 'nullable|file|mimes:jpeg,png,jpg,gif|max:20480',
            'meta_description'=> 'nullable|string',
        ]);
        
        $image_name = date('YmdHis') . "_" . mt_rand(1, 999999) . "." . $request->file('meta_keywords')->getClientOriginalExtension();
        
        $image_path = $request->file('meta_keywords')->move('website/blog', $image_name);

        $image_name =  'blog'.'/'.$image_name;

        $category = new Category;
        $category->name = $validatedData['title'];
        $category->slug = $validatedData['slug'];
        $category->meta_title = $validatedData['meta_title'];
        $category->meta_keywords = $image_name;
        $category->meta_description = $request->meta_description;
        $category->save();

        return redirect()->back()->with('message', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('message', 'Successful! Category deleted successfully.!');
    }
}
