<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Products;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $categories = Categories::all();
        return view('order.index',[
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function check()
    {
        return view('order.check');
    }

    public function process_check($purchase_order_code)
    {
        $order = transaction::findOrFail($purchase_order_code);
        return redirect()->route('order.check_result')->with('message', 'Data Pesanan Anda');
    }

    // public function JSONCategory()
    // {
    //     $categories = Categories::all();
    //     return view('kategori', compact('kategori'));
    // }

    // public function JSONProduct()
    // {
    //     $categories = Input::get('category_id');
    //     $product = Product::where('product_id', '=', $categories)->get();
    //     return response()->json($product);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
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
            'buyer_name' => 'required|min:3|max:25',
            'buyer_address' => 'required',
            'buyer_phone' => 'required',
        ]);
        die(json_encode($request->all()));
        foreach($request as $key => $value){
            $map = 
            $explode = explode('|',$value);
            dd($explode);
        };
        // foreach ($request as $request){
        //     $explode 
        // }
        $products = Products::all();
        $categories = Categories::all();
        dd($request->all());
        $order = new Order;
        $order-> buyer_name =$request->buyer_name;
        $order-> buyer_address =$request->buyer_address;
        $order-> buyer_phone =$request->buyer_phone;
        // foreach ($categories as $category){
        //     // $order->{{$category->id}}/produk = $request->{{}}
        // };
        $order-> save();
        return redirect()->route('order.success')->with('message','Pesanan anda berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('order.check');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
