<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Products;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function JSONCategory(){
        $categories = Categories::all();
        return response()->json($categories);
        // return view('order.index', compact('categories'));
    }
    public function JSONProduct(){
        // $category_id = Input::get('category_id');
        // $products = Products::where('category_id', '=', $category_id)->get();
        $products = Products::all()->groupBy('category_id');
        return response()->json($products);
    }

    public function JSONStore(Request $request)
    {
        // dd($request);
        // $request= $_POST['json'];
        $json = $request->all();

        $array = json_encode($json);
        // echo '<pre>';
        // print_r($array);
        // echo '</pre>';

        foreach ($array as $item) {
            $nama = $item['buyer_name'];
            $alamat = $item['buyer_address'];
            $telepon = $item['buyer_phone'];
            $pesanan = $item['order'];
            foreach ( $pesanan as $item2 ) {
                $namaitem = $item2['product_id'];
            }
        }
        // if ($request->ajax()) {
        //     dd($request);
        // }
        
        // $data = $request->all();
        // var_dump($data);
        // print_r(json_decode($data,TRUE));
        // die;
        // dd(json_decode($data, TRUE));
        // dd($request->ajax());
    }
        //ini ajax buat simpan

    public function index()
    {
        $products = Products::all();
        $categories = Categories::all();
        return view('order.index',[
            'products' => $products,
            'categories' => $categories
        ]);
        // $categories = Categories::all();
        // return view('order.index', compact('categories'));
    }

    public function index2($id)
    {
        $products = Products::where('category_id', $id)->get();
        return json_encode($products);
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
    private function generatePurchaseOrderCode()
    {
        return time();
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'buyer_name' => 'required|min:3|max:25',
        //     'buyer_address' => 'required',
        //     'buyer_phone' => 'required',
        // ]);
        // $r = $request->all();
        // $pdo = DB::connection()->getPdo();
        // $st = $pdo->prepare("INSERT INTO transaction (buyer_name,buyer_address,buyer_phone,status,purchase_order_code,updated_by,created_at,updated_at) VALUES (:buyer_name,:buyer_address,:buyer_phone,'pending',:purchase_order_code,:updated_by,:created_at,:updated_at);");

        // $st->execute([
        //     ':buyer_name'=>$r['buyer_name'], 
        //     ':buyer_phone'=>$r['buyer_phone'],
        //     ':buyer_address'=>$r['buyer_address'],
        //     ':purchase_order_code'=>$this->generatePurchaseOrderCode(),
        //     ':updated_by'=>null,
        //     ':created_at'=>date("Y-m-d H:i:s"),
        //     ':updated_at'=>null
        // ]);
        // $a1 = []; $pointer = 0;
        // $id = $pdo->lastInsertId();
        // foreach($r as $k => $v){
        //     if ($st !== null) {
        //         $k = $a = explode("/",$k,2);
        //         $p = count($k) > 1 and $k = explode("|",$v,2);
        //         $p and $a[1] === "produk" and $a1[$pointer]['product_id'] = $k[1];
        //         $p and $a[1] === "amount" and ($a1[$pointer]['created_at'] = date('Y-m-d H:i:s') xor $a1[$pointer]['updated_at'] = null xor $a1[$pointer]['transaction_id'] = $id xor
        //         $a1[$pointer]['amount'] = $k[0] xor $pointer++);
        //     }
        // }
        // dd($r);
        // \DB::table('transaction_data')->insert($a1);
        var_dump($_POST);
        die;
        // die(file_get_contents("php://input"));
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
        foreach ($categories as $category){
            // $order->{{$category->id/produk}} = $request->{{}}
        };
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
