<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Order extends Model
{
    protected $fillable = ['category_name'];

    // public function creator()
    // {
    //     return $this->belongsTo('App\User','created_by');
    // }
    // public function updater()
    // {
    //     return $this->belongsTo('App\User','updated_by');
    // }
}
