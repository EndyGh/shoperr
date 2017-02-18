<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $cats = Category::all();
        $data = [
            'page_header'=>"New category",
            'categories' => $cats
        ];
        return view('admin.categories.category')->with($data);
    }

    public function create(Request $request)
    {
        $category = new Category();
        $parent_cat_id = (int)$request->input('parent-category');
        $this->validate($request, [
            'name' => 'required|unique:categories|max:255',
        ]);

        $category->fill($request->all());
        $category->active = $request->get('active')=='on'?1:0;
        $category->generatePath()->save();

        if($parent_cat_id !== 0) {
            $parent_category = Category::find($parent_cat_id);
            $parent_category->appendNode($category);
            $category->generatePath()->save();
        }
        flash()->overlay('Record was created successfully!', 'Success');
        return redirect()->back();
    }


    public function edit()
    {
        $page_header = "Edit categories";
        $categories = Category::paginate(20);
        return view('admin.categories.category-edit')->with(
            compact('page_header','categories')
        );
    }

    public function update($id)
    {
        return view('admin.categories.category')->with([
            'page_header' => 'Update category',
            'category' =>Category::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function postUpdate(Request $request,$id)
    {
        $category = Category::findOrFail($id);
        $parent_cat_id = (int)$request->input('parent-category');
        $category->fill($request->all());
        $category->active = $request->get('active')=='on'?1:0;
        $category->generatePath()->save();

        if($parent_cat_id !== 0) {
            $parent_category = Category::find($parent_cat_id);
            $parent_category->appendNode($category);
            $category->generatePath()->save();
        }

        flash()->overlay('Record was updated successfully!', 'Success');
        return redirect()->back();
    }

    public function delete($id)
    {
        Category::destroy($id);
        if(request()->ajax()){
            return "Deleted";
        }
        return redirect()->route('category.edit');
    }
}
