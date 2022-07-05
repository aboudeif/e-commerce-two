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
     * index for products as json
     * 
     * @return json
     */
    public function indexJson()
    {
        //show all categories
        $subcategories = Subcategory::orderBy('created_at', 'desc')
                              ->get();
       
        return response()->json($subcategories);
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
        $subcategory->category_id = $request->subcatCat;
        $subcategory->description = $request->subcatDescription;
        $subcategory->is_deleted = $request->subcatIs_deleted;
        $subcategory->save();
        return redirect('/admin/subcategories?id='.$subcategory->category_id);

    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    
    {
        //show subcategory
        $subcategory = Subcategory::find($request->id);
        $subcategory->category_name = Category::find($subcategory->category_id)->name;
        $subcategory->products = Product::where('subcategory_id', $request->id)
                                        ->where('is_deleted', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);
                                  
        return view('admin.subcategories.show', ['subcategory' => $subcategory]);
    }

    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    
    {
        //show subcategory
        $subcategory = Subcategory::find($request->id);
        $subcategory->category_name = Category::find($subcategory->category_id)->name;
        $subcategory->products = Product::where('subcategory_id', $request->id)
                                        ->where('is_deleted', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);
                                  
        return view('admin.subcategories.link', ['subcategory' => $subcategory, 'products' => Product::all()]);
    }

     /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function link(Request $request)
    
    {
        //

        $product = Product::find($request->product_id);
        
        $product->subcategory_id = $request->id;
        $product->save();

        $subcategory = Subcategory::find($request->id);
        $subcategory->category_name = Category::find($subcategory->category_id)->name;
        $subcategory->products = Product::where('subcategory_id', $request->id)
                                        ->where('is_deleted', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->paginate(15);
                                  
        return view('admin.subcategories.link', ['subcategory' => $subcategory, 'products' => Product::all()]);
        
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
     * 
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        //delete subcategory
        if(!Product::where('subcategory_id', $subcategory->id)->exists())
        {
        $subcategory->delete();
        return redirect('/admin/subcategories');
        }
        else
        {
        $subcategory->is_deleted = 1;
        $subcategory->save();
        return redirect('/admin/subcategories');
        }

    }
}
