<?php

namespace App\Http\Controllers;

use App\Products;
use App\Categories;
use App\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::orderBy('id')->paginate(5);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Categories::get();
        return view('products.create',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'product_code' => 'required|min:1|max:10|unique:products',
            'product_name' => 'required|min:1|unique:products',
            'price' => 'required|min:1|max:10',
            'width' => 'min:1|max:6',
            'height' => 'min:1|max:6',
            'weight' => 'min:1|max:6',
            'unit' => 'required|min:3|max:10',
        ]);
        $products = new Products;
        $products->category_id = $request->category_id;
        $products->product_code = $request->product_code;
        $products->product_name = $request->product_name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->width = $request->width;
        $products->height = $request->height;
        $products->weight = $request->weight;
        $products->unit =$request->unit;
        $products->created_by = Auth::user()->id;
        $dir = \Config::get('constants.product_upload');
        if ($request->file('picture')) {
            $img = \Image::make($_FILES['picture']['tmp_name']);
            $path = [];
            $time = \Carbon::now()->format('YmdHis');
            $path[] = $dir.$time.'-'.$request->file('picture')->getClientOriginalName();
            \Storage::put($path[0], $img->stream()->__toString(), 'public');
            $products->picture = $time.'-'.$request->file('picture')-> getClientOriginalName();
        }
        $products->save();
        return redirect()->route('products.index')->with('message','Data berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $categories = categories::findOrFail($id);
        // return view('categories.show',compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Categories::get();
        $products = products::findOrFail($id);
        return view('products.edit',[
            'categories' => $categories],
        compact('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'product_code' => 'required|min:1|max:10',
            'product_name' => 'required|min:1',
            'price' => 'required|min:1|max:10',
            'width' => 'min:1|max:6',
            'height' => 'min:1|max:6',
            'weight' => 'min:1|max:6',
            'unit' => 'required|min:3|max:10',
        ]);
        $products = products::findOrFail($id);
        $products->category_id = $request->category_id;
        $products->product_code = $request->product_code;
        $products->product_name = $request->product_name;
        $products->description = $request->description;
        $products->price = $request->price;
        $products->width = $request->width;
        $products->height = $request->height;
        $products->weight = $request->weight;
        $products->unit =$request->unit;
        $products->updated_by = Auth::user()->id;
        $dir = \Config::get('constants.product_upload');
        if ($request->file('picture')) {
            $img = \Image::make($_FILES['picture']['tmp_name']);
            $path = [];
            $time = \Carbon::now()->format('YmdHis');
            $path[] = $dir.$time.'-'.$request->file('picture')->getClientOriginalName();
            \Storage::put($path[0], $img->stream()->__toString(), 'public');
            $products->picture = $time.'-'.$request->file('picture')-> getClientOriginalName();
        }
        $products-> save();        
        return redirect()->route('products.index')->with('message', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = products::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('message', 'Data berhasil dihapus !');
    }
}