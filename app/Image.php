<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;


class Image extends Model
{
    protected $fillable = ['url'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
