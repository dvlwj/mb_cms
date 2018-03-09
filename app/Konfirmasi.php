<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use User;

class Konfirmasi extends Model
{
    // protected $fillable = ['category_name'];
    protected $table = 'transaction';

    // public function creator()
    // {
    //     return $this->belongsTo('App\User','created_by');
    // }
    // public function updater()
    // {
    //     return $this->belongsTo('App\User','updated_by');
    // }
    // public function products() {
    //     return $this->hasMany('Product', 'category_id');
    // }
}
