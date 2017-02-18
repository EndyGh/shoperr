<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Slide;

class SliderController extends Controller
{
    /** Show new slider form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       $page_header = 'Новый слайдер';
       return view('admin.sliders.slider')
           ->withPageHeader($page_header);
    }

    public function edit()
    {
        $sliders = Slider::with('slides')->paginate(3);
        $page_header = 'Редактировать слайдеры';

        if(!$sliders->count()) return redirect()->route('slider.create');

        return view('admin.sliders.slider-edit')
            ->withSliders($sliders)
            ->withPageHeader($page_header);
    }

    /**  Create new slider with slides
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
       if( Slider::exists() ) {
           Slider::truncate(); // delete all sliders that exists
           Slide::truncate(); // delete all slides
       }

        $slider = new Slider();
        $slider->active = $request->get('active')=='on'?1:0;

        $slides = $request->file('slide');
        $slides_text = $request->input('slides-text');
        $slides_link = $request->input('slides-link');

        $this->validate($request, [
            'slide' => 'required',
        ]);

        $slider->save();

        foreach($slides as $index => $image) {
            $filename  = $image->getClientOriginalName();
            $path = public_path('upload/slides/' . $filename);
            \Image::make($image->getRealPath())->save($path);
            $slide = new Slide();
            $slide->text = $slides_text[$index];
            $slide->link = $slides_link[$index];
            $slide->image = '/upload/slides/'.$filename;
            $slide->slider_id = $slider->id;
            $slide->save();
        }

        flash()->overlay('Новый слайдер создан успешно!', 'Success');
        return redirect()->back();
    }

    public function update($id,Request $request)
    {

        $slider = Slider::findOrFail($id);
        $slider->active = $request->get('active')=='on'?1:0;
        $slides = $request->file('slide');
        $slides_text = $request->input('slides-text');
        $slides_link = $request->input('slides-link');
        $slider->save();

        if($slides) {

            $slides_attached = Slide::where('slider_id', $slider->id)->get();

            foreach ($slides_attached as $slide) {
                $filePath = public_path($slide->image);
                @unlink($filePath);
                $slide->delete();
            }

            foreach ($slides as $index => $image) {
                $filename = $image->getClientOriginalName();
                $path = public_path('upload/slides/' . $filename);
                \Image::make($image->getRealPath())->save($path);
                $slide = new Slide();
                $slide->text = $slides_text[$index];
                $slide->link = $slides_link[$index];
                $slide->image = '/upload/slides/' . $filename;
                $slide->slider_id = $slider->id;
                $slide->save();
            }

        }
        flash()->overlay('Слайдер обновлен успешно!', 'Success');
        return redirect()->back();
    }

    public function delete($id,Request $request)
    {
        $slider = Slider::findOrFail($id);
        $slides_attached = Slide::where('slider_id',$slider->id)->get();

        foreach($slides_attached as $slide ) {
            $filePath = public_path($slide->image);
            @unlink($filePath);
            $slide->delete();
        }

        $slider->delete();

        if(request()->ajax()){
            return "Deleted";
        }

        flash()->overlay('Record was deleted successfully!', 'Success');
        return redirect()->route('slider.edit');
    }
}
