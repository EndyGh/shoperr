<?php

namespace App\Services;

use Collective\Html\HtmlBuilder as Html;

class HtmlBuilder extends  Html
{

    public function wishListCompare($wishList='#',$compare='#')
    {
        return
            "<div class=\"wish-compare\">".
            "<a class=\"btn-add-to-wishlist\" href=\"$wishList\">add to wishlist</a>".
            "<a class=\"btn-add-to-compare\" href=\"$compare\">compare</a>".
            "</div>";
    }
}