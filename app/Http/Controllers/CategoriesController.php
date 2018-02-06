<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Auth;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = categories::orderBy('id')->paginate(5);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
            'category_name' => 'required|min:3|max:25|unique:categories'
        ]);
        // $article = Article::create($request->all());
        // $categories = categories::create($request->all());
        $categories = new Categories;
        $categories-> category_name =$request->category_name;
        $categories-> created_by = Auth::user()->id;
        $categories-> save();
        return redirect()->route('categories.index')->with('message','Data berhasil ditambahkan !');
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
        $categories = categories::findOrFail($id);
        return view('categories.edit', compact('categories'));
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
            'category_name' => 'required|min:3|unique:categories'
        ]);

        
        $categories = Categories::findOrFail($id);
        $categories-> category_name =$request->category_name;
        $categories-> updated_by = Auth::user()->id;
        $categories-> save();
        
        // $categories = categories::findOrFail($id)->update($request->all());
        // $categories-> updated_by = Auth::user()->id;
        // $categories-> save();

        return redirect()->route('categories.index')->with('message', 'Data berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = categories::findOrFail($id)->delete();
        return redirect()->route('categories.index')->with('message', 'Data berhasil dihapus !');
    }
}
