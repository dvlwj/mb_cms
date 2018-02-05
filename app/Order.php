<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Categories;
use Products;

class Order extends Model
{
    protected $fillable = ['buyer_name','buyer_address','buyer_phone'];


    public function product_name()
    {
        return $this->belongsTo('App\Products','products');
    }
    // public function 
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
