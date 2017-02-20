<?php

namespace App;

use App\User;
use App\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed created_at
 */
class Review extends Model
{
    protected $table = 'reviews';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('approved', true);
    }

    public function scopeSpam($query)
    {
        return $query->where('spam', true);
    }

    public function scopeNotSpam($query)
    {
        return $query->where('spam', false);
    }

    public function getTimeagoAttribute()
    {
        $date = Carbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }


    public function getShortCommentAttribute()
    {
        return str_limit($this->comment,30);
    }
}
