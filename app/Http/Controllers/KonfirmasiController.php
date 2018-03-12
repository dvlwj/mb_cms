<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Konfirmasi;
use App\User;
use Auth;
use DB;
use Carbon;


class KonfirmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confirm = Konfirmasi::orderBy('created_at')->paginate(5);
        return view('confirm.index', compact('confirm'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('confirm.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function accept($id)
    {
        $confirm  = array(
            'status' => 2,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        );
        // dd($confirm);
        DB::table('transaction')->where('transaction_id',$id)->update($confirm);
        return redirect()->route('confirm.index')->with('message', 'Pesanan berhasil diterima !');
    }

    public function reject($id)
    {
        $confirm  = array(
            'status' => 3,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now()
        );
        DB::table('transaction')->where('transaction_id',$id)->update($confirm);
        return redirect()->route('confirm.index')->with('message', 'Pesanan berhasil ditolak !');
    }

    public function update(Request $request, $id)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 
    }
}
