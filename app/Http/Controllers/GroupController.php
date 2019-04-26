<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Group;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class GroupController extends Controller
{
	public function AllGet()
	{
		$groups = Group::orderBy('name','desc')->paginate(10);

		return view('admin.groups', [
			'groups' => $groups,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories'
		]);

		$group = new Group();
		$group->name = $request['name'];
		$group->save();

		return redirect('/admin/group')->with([
			'message' => 'گروه افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories',
		]);

		$group = Group::find($request['id']);
		$group->name = $request['name'];
		$group->update();

        return redirect('/admin/group')->with([
			'message' => 'گروه ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$group = Group::find($id);

		if (!$group) {
            return redirect('/admin/group')->with([
				'message' => 'گروه پیدا نشد',
			]);
		}

		$group->delete();

		return redirect()->back()->with([
			'message' => 'گروه حذف شد',
		]);
	}
}
