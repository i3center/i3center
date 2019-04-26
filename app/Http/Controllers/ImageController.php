<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Image;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	public function AllGet()
	{
		$images = Image::all();;

		return view('admin.images', [
			'images' => $images,
		]);
	}

    public function EditGet($id)
    {
        $image = Image::find($id);

        if (!$image) {
            return redirect('admin/image')->with([
                'message' => 'نمایه پیدا نشد',
            ]);
        }

        return view('admin.image_form', [
            'image' => $image,
        ]);
    }

	public function EditPost(Request $request)
	{
		$this->validate($request, [
            'title' => 'max:128',
            'caption' => 'max:255',
		]);

		$image = Image::find($request['id']);
        $image->title = $request['title'];
        $image->caption = $request['caption'];
        $image->url = $request['url'];
        $image->image = $request['image'];
		$image->update();

        return redirect('admin/image')->with([
			'message' => 'نمایه ویرایش شد',
		]);
	}
}
