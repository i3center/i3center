<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Teacher;
use App\Degree;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function AllGetForAdmin()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();

        return view('admin.teachers', [
            'teachers' => $teachers,
        ]);
    }

    public function AllGetForClient()
    {
        $teachers = Teacher::orderBy('name', 'asc')->get();

        return view('client.teachers', [
            'teachers' => $teachers,
        ]);
    }

    public function SingleGet($id)
    {
        $teacher = Teacher::find($id);

        if (!$teacher) {
            return redirect()->back()->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        $i3classes_new = I3class::where('state', '=', '1')
            ->where('teacher_id', '=', $id)
            ->orderBy('state', 'desc')->get();

        $i3classes_current = I3class::where('state', '=', '2')
            ->where('teacher_id', '=', $id)
            ->orderBy('state', 'desc')->get();

        $i3classes_old = I3class::where('state', '=', '3')
            ->where('teacher_id', '=', $id)
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

        return view('client.teacher', [
            'teacher' => $teacher,
            'i3classes_all' => $i3classes_all,
        ]);
    }

    public function AddGet()
    {
        $degrees = Degree::orderBy('name', 'desc')->get();

        return view('admin.teacher_form', [
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
        $teacher->username = $request['username'];
        $teacher->password = $request['password'];
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
        $degrees = Degree::orderBy('name', 'desc')->get();

        if (!$teacher) {
            return redirect('/admin/teacher')->with([
                'message' => 'استاد پیدا نشد',
            ]);
        }

        return view('admin.teacher_form', [
            'teacher' => $teacher,
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
        $teacher->username = $request['username'];
        $teacher->password = $request['password'];
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

    private function shortenText($text, $len)
    {
        if (str_word_count($text) > $len) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$len]) . '...';
        }
        return $text;
    }
}
