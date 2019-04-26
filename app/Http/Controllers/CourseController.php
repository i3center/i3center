<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Course;
use App\Group;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function AllGetForAdmin()
    {
        $courses = Course::select('courses.*', 'groups.name AS group_name')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->orderBy('created_at', 'desc')->get();

        return view('admin.courses', [
            'courses' => $courses,
        ]);
    }

    public function AllGetForClient()
    {
        $courses = Course::select('courses.*')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('created_at', 'desc')->get();

        return view('client.courses', [
            'courses' => $courses,
        ]);
    }

    public function SingleGet($id)
	{
		$course = Course::find($id);

		if(!$course)
		{
			return redirect()->back()->with([
				'message' => 'دوره آموزشی پیدا نشد',
			]);
		}

        $i3classes_new = I3class::where('state', '=', '1')
            ->where('course_id', '=', $id)
            ->orderBy('state', 'desc')->get();

        $i3classes_current = I3class::where('state', '=', '2')
            ->where('course_id', '=', $id)
            ->orderBy('state', 'desc')->get();

        $i3classes_old = I3class::where('state', '=', '3')
            ->where('course_id', '=', $id)
            ->orderBy('state', 'desc')->get();

        $i3classes_all = array(
            array('title' => 'در حال ثبت نام', 'name' => 'new', 'value' => $i3classes_new),
            array('title' => 'در حال برگزاری', 'name' => 'current', 'value' => $i3classes_current),
            array('title' => 'قدیمی', 'name' => 'old', 'value' => $i3classes_old)
        );

        foreach ($i3classes_all as $i3classes) {
            foreach ($i3classes["value"] as $i3class) {
                if (json_decode($i3class->weekdays, true)) {
                    $i3class->weekdays = join(" . ", json_decode($i3class->weekdays, true));
                } else {
                    $i3class->weekdays = '';
                }
                $i3class->capacity = tr_num($i3class->capacity, 'fa');
                $i3class->start_date = tr_num($i3class->start_date, 'fa');
                $i3class->start_time = tr_num(date("H:i", strtotime($i3class->start_time)), 'fa');
                $i3class->end_time = tr_num(date("H:i", strtotime($i3class->end_time)), 'fa');
            }
        }

        return view('client.course', [
			'course' => $course,
            'i3classes_all' => $i3classes_all,
		]);
	}

	public function AddGet()
	{
		$groups = Group::orderBy('name','asc')->get();

		return view('admin.course_form', [
			'groups' => $groups,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120',
			'explanation' => 'required',
			'description' => 'required|max:256',
		]);

		$course = new Course();
		$course->name = $request['name'];
		$course->explanation = $request['explanation'];
        $course->group_id = $request['group_id'];
		$course->price = $request['price'];
		$course->time = $request['time'];
		$course->description = $request['description'];
		$course->keywords = $request['keywords'];
		$course->image = $request['image'];
        $course->special = $request['special'];
		$course->save();

		return redirect('/admin/course')->with([
			'message' => 'دوره آموزشی افزوده شد',
		]);
	}

	public function EditGet($topic_id)
	{
		$course = Course::find($topic_id);
        $groups = Group::orderBy('name','asc')->get();

        if (!$course) {
			return redirect()->route('admin.course.all.get')->with([
				'message' => 'دوره آموزشی پیدا نشد',
			]);
		}

		return view('admin.course_form', [
			'course' => $course,
            'groups' => $groups,
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120',
            'explanation' => 'required',
			'description' => 'required|max:256',
			'keywords' => 'required'
		]);

		$course = Course::find($request['id']);
		$course->name = $request['name'];
        $course->explanation = $request['explanation'];
        $course->group_id = $request['group_id'];
        $course->price = $request['price'];
        $course->time = $request['time'];
        $course->description = $request['description'];
        $course->keywords = $request['keywords'];
        $course->image = $request['image'];
        $course->special = $request['special'];
		$course->update();

		return redirect('/admin/course')->with([
			'message' => 'دوره آموزشی ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$course = Course::find($id);

		if (!$course) {
			return redirect()->route('admin.blog.topics.get')->with([
				'message' => 'دوره آموزشی پیدا نشد',
			]);
		}

		$course->delete();

		return redirect()->back()->with([
			'message' => 'دوره آموزشی حذف شد',
		]);
	}

	private function shortenText($text, $len)
	{
		if(str_word_count($text) > $len)
		{
			$words = str_word_count($text, 2);
			$pos = array_keys($words);
			$text = substr($text, 0,$pos[$len]) . '...';
		}
		return $text;
	}
}
