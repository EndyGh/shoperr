<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\OrderItem;
use App\OrderDetail;


class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function detail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
