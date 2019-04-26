<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Regulation;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
	public function AllGetForAdmin()
	{
		$regulations = Regulation::all();

        foreach($regulations as $regulation)
        {
            $regulation->body = $this->shortenText($regulation->body, 50);
        }

		return view('admin.regulations', [
			'regulations' => $regulations,
		]);
	}

    public function AllGetForClient()
    {
        $regulations = Regulation::all();

        return view('client.regulations', [
            'regulations' => $regulations,
        ]);
    }

    public function AddGet()
    {
        return view('admin.regulation_form');
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:255'
		]);

		$regulation = new Regulation();
        $regulation->title = $request['title'];
        $regulation->body = $request['body'];
		$regulation->save();

		return redirect('/admin/regulation')->with([
			'message' => 'آیین نامه افزوده شد',
		]);
	}

    public function EditGet($id)
    {
        $regulation = Regulation::find($id);

        if (!$regulation) {
            return redirect('/admin/i3class')->with([
                'message' => 'آیین نامه پیدا نشد',
            ]);
        }
        return view('admin.regulation_form', [
            'regulation' => $regulation,
        ]);
    }

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'title' => 'required|max:255',
		]);

		$regulation = Regulation::find($request['id']);
        $regulation->title = $request['title'];
        $regulation->body = $request['body'];
		$regulation->update();

        return redirect('/admin/regulation')->with([
			'message' => 'آیین نامه ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$regulation = Regulation::find($id);

		if (!$regulation) {
            return redirect('/admin/regulation')->with([
				'message' => 'آیین نامه پیدا نشد',
			]);
		}

		$regulation->delete();

		return redirect()->back()->with([
			'message' => 'آیین نامه حذف شد',
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
