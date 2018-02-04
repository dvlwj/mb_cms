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
        $categories = Categories::get();
        $products = Products::get();
        // dd($order);
        return view('order.index',[
            'categories' => $categories,
            'products' => $products
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
            'name' => 'required|min:3|max:25|unique:users',
            'username' => 'required|min:3|max:25|unique:users',
            'userlevel' => 'required',
            'email' => 'required|max:25|unique:users',
            'password' => 'required|min:3',
        ]);
        // $article = Article::create($request->all());
        // $categories = categories::create($request->all());
        $users = new User;
        $users-> name =$request->name;
        $users-> username =$request->username;
        $users-> userlevel =$request->userlevel;
        $users-> email =$request->email;
        $users-> password =Hash::make($request->password);
        $users-> created_by = Auth::user()->id;
        $users-> save();
        return redirect()->route('order.index')->with('message','Data berhasil ditambahkan !');
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
