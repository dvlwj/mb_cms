<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Categories extends Model
{
    protected $fillable = ['category_name'];
    protected $table = 'categories';

    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public function updater()
    {
        return $this->belongsTo('App\User','updated_by');
    }
    // public function products() {
    //     return $this->hasOne('Products', 'category_id');
    // }
}
