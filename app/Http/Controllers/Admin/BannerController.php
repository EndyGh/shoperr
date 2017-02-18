<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function showCreateBannerPage()
    {
       # return view('admin.banners.banner')
       # ->withPageHeader('Добавить новый баннер');
    }

    public function showEditBannerPage()
    {

    }

    public function storeBanner(Request $request)
    {

    }

    public function updateBanner(Request $request)
    {

    }

    public function deleteBanner(Request $request)
    {

    }
}
