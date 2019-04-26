<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Off;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class OffController extends Controller
{
	public function AllGetForAdmin()
	{
		$offs = Off::all();

		return view('admin.offs', [
			'offs' => $offs,
		]);
	}

    public function AllGetForClient()
    {
        $offs = Off::all();

        return view('client.offs', [
            'offs' => $offs,
        ]);
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:512'
		]);

		$off = new Off();
		$off->title = $request['title'];
		$off->value = $request['value'];
		$off->save();

		return redirect('/admin/off')->with([
			'message' => 'تخفیف افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
            'title' => 'required|max:512'
		]);

		$off = Off::find($request['id']);
        $off->title = $request['title'];
        $off->value = $request['value'];
		$off->update();

        return redirect('/admin/off')->with([
			'message' => 'تخفیف ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$off = Off::find($id);

		if (!$off) {
            return redirect('/admin/off')->with([
				'message' => 'تخفیف پیدا نشد',
			]);
		}

		$off->delete();

		return redirect()->back()->with([
			'message' => 'تخفیف حذف شد',
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
