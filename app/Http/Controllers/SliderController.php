<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Slider;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function AllGet()
    {
        $sliders = Slider::orderBy('order', 'desc')->paginate(10);

        return view('admin.sliders', [
            'sliders' => $sliders,
        ]);
    }

    public function AddGet()
    {
        return view('admin.slider_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:60',
            'caption' => 'max:120',
        ]);

        $slider = new Slider();
        $slider->title = $request['title'];
        $slider->caption = $request['caption'];
        $slider->url = $request['url'];
        $slider->image = $request['image'];
        $slider->save();

        return redirect('admin/slider')->with([
            'message' => 'اسلایدر افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect('admin/slider')->with([
                'message' => 'دانشجو پیدا نشد',
            ]);
        }

        return view('admin.slider_form', [
            'slider' => $slider,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'max:60',
            'caption' => 'max:120',
        ]);

        $slider = Slider::find($request['id']);
        $slider->title = $request['title'];
        $slider->caption = $request['caption'];
        $slider->url = $request['url'];
        $slider->image = $request['image'];
        $slider->update();

        return redirect('admin/slider')->with([
            'message' => 'اسلایدر ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect('admin/slider')->with([
                'message' => 'اسلایدر پیدا نشد',
            ]);
        }

        $slider->delete();

        return redirect()->back()->with([
            'message' => 'اسلایدر حذف شد',
        ]);
    }
}
