<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Page;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        return view('admin.pages.page')->with(['page_header'=>"New page",'page'=>collect([])]);
    }

    public function create(Request $request)
    {
        $page = new Page();

        $this->validate($request, [
            'path' => 'required|unique:pages|max:155',
        ]);

        $page->fill($request->all());
        $page->path = str_slug($request->input('path'));
        $page->active = $request->get('active')=='on'?1:0;
        $page->save();
        flash()->overlay('Record was created successfully!', 'Success');
        return redirect()->back();
    }

    public function edit()
    {
        $page_header = "Edit pages";
        $pages = Page::paginate(5);
        return view('admin.pages.page-edit')->with(
            compact('page_header','pages')
        );
    }

    public function update($id)
    {
        return view('admin.pages.page')->with([
            'page_header' => 'Update page',
            'page' =>Page::findOrFail($id),
        ]);
    }

    public function postUpdate(Request $request,$id)
    {
        $page = Page::findOrFail($id);
        $page->fill($request->all());
        $page->active = $request->get('active')=='on'?1:0;
        $page->save();

        flash()->overlay('Record was updated successfully!', 'Success');
        return redirect()->back();
    }

    public function delete($id)
    {
        Page::destroy($id);
        if(request()->ajax()){
            return "Deleted";
        }
        return redirect()->route('page.edit');
    }
}


