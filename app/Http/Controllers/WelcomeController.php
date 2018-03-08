<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Categories;
use App\Products;
use App\Welcome;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Products::all();
        $categories = Categories::all();
        return view('welcome',[
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $search = $request['searchbar'];
        $products = Products::where('product_name','like', '%'.$search.'%')->orderBy('product_name','ASC');
        $categories = Categories::all();
        return view('welcome',[
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function show($id)
    {
        $products = Products::findOrFail($id);
        $categories = Categories::all();
        return view('showproducts', [
            'products'=>$products,
            'categories' => $categories
        ]);
    }
}
