<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Degree;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
	public function AllGet()
	{
		$degrees = Degree::orderBy('name','desc')->paginate(10);

		return view('admin.degrees', [
			'degrees' => $degrees,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories'
		]);

		$degree = new Degree();
		$degree->name = $request['name'];
		$degree->save();

		return redirect('/admin/degree')->with([
			'message' => 'تحصیلات افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories',
		]);

		$degree = Degree::find($request['id']);
		$degree->name = $request['name'];
		$degree->update();

        return redirect('/admin/degree')->with([
			'message' => 'تحصیلات ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$degree = Degree::find($id);

		if (!$degree) {
            return redirect('/admin/degree')->with([
				'message' => 'تحصیلات پیدا نشد',
			]);
		}

		$degree->delete();

		return redirect()->back()->with([
			'message' => 'تحصیلات حذف شد',
		]);
	}
}
