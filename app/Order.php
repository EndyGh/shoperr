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

    /** Order Item relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function details()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
