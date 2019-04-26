<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Classroom;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
	public function AllGet()
	{
		$classrooms = Classroom::orderBy('name','desc')->paginate(10);

		return view('admin.classrooms', [
			'classrooms' => $classrooms,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories'
		]);

		$classroom = new Classroom();
		$classroom->name = $request['name'];
		$classroom->save();

		return redirect('/admin/classroom')->with([
			'message' => 'کلاس افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories',
		]);

		$classroom = Classroom::find($request['id']);
		$classroom->name = $request['name'];
		$classroom->update();

        return redirect('/admin/classroom')->with([
			'message' => 'کلاس ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$classroom = Classroom::find($id);

		if (!$classroom) {
            return redirect('/admin/classroom')->with([
				'message' => 'کلاس پیدا نشد',
			]);
		}

		$classroom->delete();

		return redirect()->back()->with([
			'message' => 'کلاس حذف شد',
		]);
	}
}
