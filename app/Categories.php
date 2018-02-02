<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;

class Categories extends Model
{
    protected $fillable = ['category_name'];

    public function username()
    {
        return $this->belongsTo(User);
    }
}
