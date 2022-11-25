<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('admin');
        return view('dashboard.categories.index',[
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('admin');
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('admin');
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'slug' => 'required|unique:categories',
            'image' => 'image|file|max:2048'
        ]);

        if($request->file('image')){
            $validatedData['image']  = $request->file('image')->store('category-images');
        }

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $this->authorize('admin');
        return view('dashboard.categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $this->authorize('admin');
        $rules = [
            'name' => 'required|max:50',
            'image' => 'image|file|max:2048'
        ];

        if($request->slug != $category->slug){
            $rules['slug'] = 'required|unique:categories';
        }

        $validatedData = $request->validate($rules);
        if($request->file('image')){
            if($request->oldImage){Storage::delete($category->image);}
            
            $validatedData['image']  = $request->file('image')->store('category-images');
        }

        Category::where('id', $category->id)
              ->update($validatedData);

        return redirect('/dashboard/categories')->with('success', 'Category berhasil di update!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('admin');
        if($category->image){Storage::delete($category->image);}
        Comment::where('post_id', $category->posts->id)->delete();
        Post::where('category_id', $category->id)->delete();
        Category::destroy($category->id);
        
        return redirect('/dashboard/categories')->with('success', 'Category berhasil dihapus!');
    }

    public function createSlug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);

    }
}
