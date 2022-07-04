<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $subcategories = Subcategory::where('category_id', $request->id)
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(15);
                            
        return view('admin.subcategories.index', ['subcategories' => $subcategories, 'category' => Category::find($request->id)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new subcategory
        $categories = Category::all();
        return view('admin.subcategories.create', ['categories' => $categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store new subcategory
        $subcategory = new Subcategory;
        $subcategory->name = $request->subcatName;
        $subcategory->category_id = $request->category_id;
        $subcategory->is_deleted = 0;
        $subcategory->save();
        return redirect('/admin/subcategories?id='.$request->category_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show subcategory
        $subcategory = Subcategory::find($id);
        return view('admin.subcategories.show', ['subcategory' => $subcategory]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //edit subcategory and pass category id to view
        $subcategory = Subcategory::find($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', ['subcategory' => $subcategory, 'categories' => $categories]);
        
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
        //update subcategory and pass category id to view
        $subcategory = Subcategory::find($id);
        $subcategory->name = $request->subcatName;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        return redirect('/admin/subcategories?id='.$request->category_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete subcategory
        $subcategory = Subcategory::find($id);
        $subcategory->is_deleted = 1;
        $subcategory->save();
        return redirect('/admin/subcategories?id='.$subcategory->category_id);
        
    }
}
