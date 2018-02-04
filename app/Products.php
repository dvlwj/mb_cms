<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Categories;

class Products extends Model
{
    protected $fillable = [
        'product_code', 'product_name', 'picture', 'description', 'price', 'width', 'height', 'weight', 'unit',
    ];

    public function category()
    {
        return $this->belongsTo('App\Categories','Category');
    }

    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public function updater()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
