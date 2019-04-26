<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Category;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function AllGet()
	{
		$categories = Category::orderBy('name','desc')->paginate(10);

		return view('admin.blog.categories', [
			'categories' => $categories,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories'
		]);

		$category = new Category();
		$category->name = $request['name'];
		$category->description = $request['description'];
		$category->save();

		return redirect('admin/blog/category')->with([
			'message' => 'دسته بندی افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120|unique:categories',
		]);

		$category = Category::find($request['id']);
		$category->name = $request['name'];
        $category->description = $request['description'];
		$category->update();

		return redirect('admin/blog/category')->with([
			'message' => 'دسته بندی ویرایش شد',
		]);
	}

	public function DeleteGet($post_id)
	{
		$category = Category::find($post_id);

		if (!$category) {
            return redirect()->back()->with([
				'message' => 'دسته بندی پیدا نشد',
			]);
		}

		$category->delete();

		return redirect()->back()->with([
			'message' => 'دسته بندی حذف شد',
		]);
	}
}