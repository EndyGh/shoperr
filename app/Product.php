<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Image;
use App\Review;
use Conner\Tagging\Taggable;

class Product extends Model
{
    use Taggable;

    protected $fillable = ['name','title','description','price_usd','code','guarantee','amount','active'];


    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class,'property_product')->withTimestamps();
    }

    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class)->withTimestamps();
    }

    public function setPriceUahAttribute($value)
    {
        return $value ?
            ($this->attributes['price_uah'] = $value*round( $this->price_usd, 2) ) :
            $this->attributes['price_uah'];
    }

    public function setNameAttribute($name){
        $this->attributes['name'] = ucfirst(str_slug($name , "-"));
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // The way average rating is calculated (and stored) is by getting an average of all ratings,
    // storing the calculated value in the rating_cache column (so that we don't have to do calculations later)
    // and incrementing the rating_count column by 1
    public function recalculateRating()
    {
        $reviews = $this->reviews(); #->notSpam()->approved();
        $avgRating = $reviews->avg('rating');
        $this->rating_cache = round($avgRating,1);
        $this->rating_count = $reviews->count();
        $this->save();
    }
}
