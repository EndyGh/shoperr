<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        $data = ['page_header'=>"New brand"];
        return view('admin.brands.brand')->with($data);
    }

    public function create(Request $request)
    {
        $brand = new Brand();

        $this->validate($request, [
            'name' => 'required|unique:brands|max:255',
        ]);

        $brand->fill($request->all());
        $brand->save();
        flash()->overlay('Record was created successfully!', 'Success');
        return redirect()->back();
    }

    public function edit()
    {
        $page_header = "Edit brands";
        $brands = Brand::paginate(5);
        return view('admin.brands.brand-edit')->with(
            compact('page_header','brands')
        );
    }

    public function update($id)
    {
        return view('admin.brand')->with([
            'page_header' => 'Update brand',
            'brand' =>Brand::findOrFail($id),
        ]);
    }

    public function postUpdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $brand->fill($request->all());
        $brand->save();

        flash()->overlay('Record was updated successfully!', 'Success');
        return redirect()->back();
    }

    public function delete($id)
    {
        Brand::destroy($id);
        if(request()->ajax()){
            return "Deleted";
        }
        return redirect()->route('brand.edit');
    }
}


