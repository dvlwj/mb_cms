<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Categories;
use Products;

class Order extends Model
{
    protected $fillable = ['buyer_name','buyer_address','buyer_phone'];

    protected $table = 'transaction';

    public function product_name()
    {
        return $this->belongsTo('App\Products','products');
    }
}

class Transaction_data extends Model
{
    protected $table = 'transaction_data';
}
