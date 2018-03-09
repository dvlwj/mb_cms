<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $search = $request['searchtext'];
        // // $categories = Categories::all();
        $products = DB::table('products')->where('products.product_name', 'like', '%' . $search . '%')->get();
        return view('search', compact('products','search'));
        // $products = Products::where('product_name','like', '%'.$search.'%');
        // $categories = Categories::all();
        // dd($request);
        // return view('search',[
        //     'products' => $products,
        //     'categories' => $categories,
        //     'search' => $search
        // ]);
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
