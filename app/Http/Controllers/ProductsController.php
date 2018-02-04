<?php

namespace App\Http\Controllers;

use App\Products;
use App\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;;
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
        return view('products.create',compact('products'));
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
            'product_code' => 'required|min:3|unique:products',
            'product_name' => 'required|min:3|unique:products',
            'price' => 'required',
            'unit' => 'required',
        ]);
        $products = new Products;
        $products-> category_id = $request->category_id;
        $products-> product_code = $request->product_code;
        $products-> product_name = $request->product_name;
        $products-> picture = $request->picture;
        $products-> description = $request->description;
        $products-> price = $request->price;
        $products-> width = $request->width;
        $products-> height = $request->height;
        $products-> weight = $request->weight;
        $products-> unit =$request->unit;
        $products-> created_by = Auth::user()->id;
        $products-> save();
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
        $users = User::findOrFail($id);
        return view('products.edit', compact('products'));
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
            // 'name' => 'required|min:3|max:25|unique:users',
            // 'username' => 'required|min:3|max:25|unique:users',
            'userlevel' => 'required',
            // 'email' => 'required|max:25|unique:users',
            // 'password' => 'required|min:3',
        ]);

        $users = User::findOrFail($id);
        // $users-> name =$request->name;
        // $users-> username =$request->username;
        $users-> userlevel =$request->userlevel;
        // $users-> email =$request->email;
        // $users-> password =Hash::make($request->password);
        $users-> updated_by = Auth::user()->id;
        $users-> save();        
        // $categories = categories::findOrFail($id)->update($request->all());
        // $categories-> updated_by = Auth::user()->id;
        // $categories-> save();

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
        $users = User::findOrFail($id)->delete();
        return redirect()->route('products.index')->with('message', 'Data berhasil dihapus !');
    }
}