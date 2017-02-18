<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Image;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.images.image')->with([
            'page_header' => 'Add new image'
        ]);
    }

    public function create(Request $request)
    {

        $images = $request->file('image');

        $this->validate($request, [
            'image' => 'required',
        ]);

        foreach($images as $image) {
            # $filename  = time() . '.' . $image->getClientOriginalExtension();
            $filename  = $image->getClientOriginalName();
            $path = public_path('upload/' . $filename);
            $exist = Image::where('url', '/upload/' . $filename)->get();
            if(count($exist)) {
                return redirect()->back()->withErrors(['Image must be unique']);
            }
            \Image::make($image->getRealPath())->save($path);
            $img = new Image();
            $img->url = '/upload/'.$filename;
            $img->save();
        }

        flash()->overlay('Record was created successfully!', 'Success');
        return redirect()->back();
    }

    public function edit()
    {
        $images = Image::paginate(5);
        return view('admin.images.image-edit')->with([
            'page_header' => "Edit images",
            'images'=>$images
        ]);
    }

    public function delete($id)
    {
        $image = Image::find($id);
        $filePath = public_path($image->url);
        @unlink($filePath);
        $image->delete();

        if(request()->ajax()){
            return "Deleted";
        }
        flash()->overlay('Record was deleted successfully!', 'Success');
        return redirect()->route('image.edit');
    }
}
