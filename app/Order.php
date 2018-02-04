<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Order extends Model
{
    protected $fillable = ['buyer_name','buyer_address','buyer_phone'];

    // $user_id = Auth::user()->id;
    // $branch = Branch::where('user_id', '=', $user_id)->first();
    // $faculties = Faculty::where('branch_name', '=', $branch->name)->get();
    // return $products_cat =  order::where('')
    // public function product_category() {
    //     $category_id = Categories::get()->id;
    //     return $products = Products::where('category_id', '=', $category_id)->get();
    // }
    // public function product_category()
    // {
    //     return $this->belongsTo('App\Categories','categories');
    // }
    // public function creator()
    // {
    //     return $this->belongsTo('App\User','created_by');
    // }
    // public function updater()
    // {
    //     return $this->belongsTo('App\User','updated_by');
    // }
}
