<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Property extends Model
{
    protected $fillable = ['name','value'];

    public function products()
    {
        return $this->belongsToMany(Product::class,'property_product')->withTimestamps();
    }
}
