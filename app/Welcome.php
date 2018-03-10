<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Categories;

class Welcome extends Model
{
    protected $table = 'categories';

    public function categorier()
    {
        return $this->belongsTo('App\Categories','category');
    }
}
