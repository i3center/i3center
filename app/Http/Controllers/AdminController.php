<?php

namespace App\Http\Controllers;

use App\Course;
use App\I3class;
use App\Information;
use App\Message;
use App\Events\commentCreated;
use App\Slider;
use App\Student;
use App\Teacher;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use App\Topic;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	public function Index()
	{
		$topics_count = Topic::count();
		$i3classes_count = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '<>', 'ICDL')->count();

        $teachers_count = Teacher::count();
        $students_count = Student::count();
        $sliders_count = Slider::count();

        $icdl_i3classes_count = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '=', 'ICDL')->count();

        $icdl_test_number = Information::where('name', '=', 'icdl_test_number')->firstOrFail()->value;
		$new_messages_count = Message::where('new','=', '1')->count();

		return view('admin.index', [
			'topics_count' => $topics_count,
			'i3classes_count' => $i3classes_count,
			'teachers_count' => $teachers_count,
			'students_count' => $students_count,
			'sliders_count' => $sliders_count,
			'icdl_i3classes_count' => $icdl_i3classes_count,
			'icdl_test_number' => $icdl_test_number,
			'new_messages_count' => $new_messages_count,
		]);
	}

	public function LoginGet()
	{
		return view('admin.login');
	}

	public function LoginPost(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required'
		]);

		if(!Auth::attempt(['email' => $request['email'], 'password' => $request['password']]))
		{
			return redirect()->back()->with([
				'message' => 'خطا در ورود',
			]);
		}

		return redirect('/admin');
	}

	public function LogoutGet()
	{
		Auth::logout();
		return redirect('/');
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

    public function uploadImage(Request $request)
    {
        $image = $request->image;
        $model = $request->model;

        list(, $image) = explode(';', $image);
        list(, $image) = explode(',', $image);

        $image = base64_decode($image);
        $image_name = time() . '.png';

        $path = public_path("/image/$model/$image_name");
        file_put_contents($path, $image);

        return $image_name;
    }

    public function AllGet()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();

        return view('admin.teachers', [
            'teachers' => $teachers,
        ]);
    }

    public function AddGet()
    {
        $expertises = Expertise::orderBy('name', 'desc')->get();
        $degrees = Degree::orderBy('name', 'desc')->get();

        return view('admin.add_teacher', [
            'expertises' => $expertises,
            'degrees' => $degrees,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
            'description' => 'required',
        ]);

        $teacher = new Teacher();
        $teacher->name = $request['name'];
        $teacher->national_code = $request['national_code'];
        $teacher->birth_date = $request['birth_date'];
        $teacher->explanation = $request['explanation'];
        $teacher->degree_id = $request['degree_id'];
        $teacher->phone_number = $request['phone_number'];
        $teacher->email = $request['email'];
        $teacher->telegram = $request['telegram'];
        $teacher->description = $request['description'];
        $teacher->keywords = $request['keywords'];
        $teacher->image = $request['image'];
        $teacher->save();

        return redirect('/admin/teacher')->with([
            'message' => 'استاد افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $teacher = Teacher::find($id);
        $expertises = Expertise::orderBy('name', 'desc')->get();
        $degrees = Degree::orderBy('name', 'desc')->get();

        if (!$teacher) {
            return redirect('/admin/teacher')->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        return view('admin.edit_teacher', [
            'teacher' => $teacher,
            'expertises' => $expertises,
            'degrees' => $degrees,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
            'description' => 'required'
        ]);

        $teacher = Teacher::find($request['id']);

        $teacher->name = $request['name'];
        $teacher->national_code = $request['national_code'];
        $teacher->birth_date = $request['birth_date'];
        $teacher->explanation = $request['explanation'];
        $teacher->degree_id = $request['degree_id'];
        $teacher->phone_number = $request['phone_number'];
        $teacher->email = $request['email'];
        $teacher->telegram = $request['telegram'];
        $teacher->description = $request['description'];
        $teacher->keywords = $request['keywords'];
        $teacher->image = $request['image'];

        $teacher->update();

        return redirect('/admin/teacher')->with([
            'message' => 'استاد ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $teacher = Teacher::find($topic_id);

        if (!$teacher) {
            return redirect('/admin/teacher')->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        $teacher->delete();

        return redirect()->back()->with([
            'message' => 'استاد حذف شد',
        ]);
    }
}
