<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Information;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class InformationController extends Controller
{
	public function AllGet()
	{
		$informations = Information::orderBy('description','asc')->get();

        foreach($informations as $information)
        {
            $information->value = $this->shortenText($information->value, 100);
        }

		return view('admin.informations', [
			'informations' => $informations,
		]);
	}

    public function AddGet()
    {
        return view('admin.information_form');
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120'
		]);

		$information = new Information();
		$information->description = $request['description'];
		$information->name = $request['name'];
		$information->value = $request['value'];
		$information->save();

		return redirect('/admin/information')->with([
			'message' => 'اطلاعات افزوده شد',
		]);
	}

    public function EditGet($id)
    {
        $information = Information::find($id);

        if (!$information) {
            return redirect('/admin/i3class')->with([
                'message' => 'منو پیدا نشد',
            ]);
        }
        return view('admin.information_form', [
            'information' => $information,
        ]);
    }

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories',
		]);

		$information = Information::find($request['id']);
        $information->description = $request['description'];
        $information->name = $request['name'];
        $information->value = $request['value'];
		$information->update();

        return redirect('/admin/information')->with([
			'message' => 'اطلاعات ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$information = Information::find($id);

		if (!$information) {
            return redirect('/admin/information')->with([
				'message' => 'اطلاعات پیدا نشد',
			]);
		}

		$information->delete();

		return redirect()->back()->with([
			'message' => 'اطلاعات حذف شد',
		]);
	}

    private function shortenText($text, $len)
    {
        $words = explode(' ', $text);
        if(count($words) > $len)
        {
            $words = array_slice($words,0, $len);
            $text = join(" ",$words) . " ...";
        }
        return $text;
    }
}
