<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Slide;


class Slider extends Model
{
    protected $table = 'sliders';

    public function slides()
    {
        return $this->hasMany(Slide::class);
    }
}
