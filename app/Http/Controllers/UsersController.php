<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = user::orderBy('id')->paginate(5);
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
        return redirect()->route('users.index')->with('message','Data berhasil ditambahkan !');
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
        return view('users.edit', compact('users'));
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

        return redirect()->route('users.index')->with('message', 'Data berhasil diubah !');
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
        return redirect()->route('users.index')->with('message', 'Data berhasil dihapus !');
    }
}
