<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;

class HtmlBuilderFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'HtmlEx';     }
}