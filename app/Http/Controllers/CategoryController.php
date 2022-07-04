<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //protected $uniqueKey =  ['Category_id', 'name'] ;
    public function index(Request $request)
    {
        //show all categories
        $categories = Category::orderBy('created_at', 'desc')
                              ->paginate(15);
       
        return view('admin.categories.index', ['categories' => $categories]);

    }

    /**
     * index for subcategories as json
     * 
     * @return json
     */
    public function indexJson()
    {
        //show all categories
        $categories = Category::orderBy('created_at', 'desc')
                              ->get();
       
        return response()->json($categories);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new category
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store new category
        $category = new Category;
        $category->name = $request->catName;
        $category->description = $request->catDescription;
        $category->is_deleted = 0;
        $category->save();
        return redirect('/admin/categories?is_deleted=0');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
   
        //show category
        $category = Category::find($request->id);
        $category->subcategories = Subcategory::where('category_id', $request->id)
                                              ->where('is_deleted', false)
                                              ->get();
        return view('admin.categories.show', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //edit category
        return view('admin.categories.edit', ['category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //update category
        // 

        $category = Category::find($request->catId);
        $category->name = $request->catName;
        $category->description = $request->catDescription;
        $category->is_deleted = $request->catIs_deleted;
        $category->save();
        return redirect('/admin/categories?is_deleted=0');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //delete category

        if($category->is_deleted == 1 && !Subcategory::where('category_id', $category->id)->exists())
        {
        $category->delete();
        return redirect('/admin/categories?is_deleted=1');
        }
        else
        {
        $category->is_deleted = 1;
        $category->save();
        return redirect('/admin/categories?is_deleted=0');
        }
    }
}
