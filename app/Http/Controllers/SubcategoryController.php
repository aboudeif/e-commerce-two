<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        $subcategories = Subcategory::orderBy('created_at', 'desc')
                                    ->paginate(15);
                            
        return view('admin.subcategories.index', ['subcategories' => $subcategories]);
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
        $subcategory->products = Product::where('subcategory_id', $id)
                                        ->where('is_deleted', 0)
                                        ->get();
        return view('admin.subcategories.show', ['subcategory' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //edit subcategory and pass category id to view
        return view('admin.subcategories.edit', ['subcategory' => $subcategory]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //update subcategory and pass category id to view
        $subcategory = Subcategory::find($request->subcatId);
        $subcategory->name = $request->subcatName;
        $subcategory->description = $request->subcatDescription;
        $subcategory->category_id = $request->subcatCat;
        $subcategory->is_deleted = $request->subcatIs_deleted;
        $subcategory->save();
        return redirect('/admin/subcategories?id='.$subcategory->category_id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //delete subcategory
        if($subcategory->is_deleted == 1 && !Product::where('subcategory_id', $subcategory->id)->exists())
        {
        $subcategory->delete();
        return redirect('/admin/subcategories?is_deleted=1');
        }
        else
        {
        $subcategory->is_deleted = 1;
        $subcategory->save();
        return redirect('/admin/subcategories?is_deleted=0');
        }

    }
}
