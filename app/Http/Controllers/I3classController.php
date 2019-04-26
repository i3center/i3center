<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Teacher;
use App\Course;
use App\Classroom;
use App\I3class;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class I3classController extends Controller
{
    public function AllGetForAdmin()
    {
        $i3classes = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('state', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $icdl_i3classes = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '=', 'ICDL')
            ->orderBy('state', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();

        $i3classes_all = array(
            array('title' => 'کلاس های تخصصی', 'name' => 'i3classes', 'value' => $i3classes),
            array('title' => 'کلاس های ICDL', 'name' => 'icdl_i3classes', 'value' => $icdl_i3classes),
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
        return view('admin.i3classes', [
            'i3classes_all' => $i3classes_all,
        ]);
    }

    public function AllGetForClient()
    {
        $i3classes_new = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('state', '=', '1')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('state', 'desc')->get();

        $i3classes_current = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('state', '=', '2')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('state', 'desc')->get();

        $i3classes_old = I3class::select('i3classes.*')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('state', '=', '3')
            ->where('groups.name', '<>', 'ICDL')
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

        return view('client.i3classes', [
            'i3classes_all' => $i3classes_all,
        ]);
    }

    public function SingleGet($id)
    {
        $i3class = I3class::where('i3classes.id', $id)->first();

        $i3class->weekdays = join(" . ", json_decode($i3class->weekdays, true));
        $i3class->start_time = tr_num(date("H:i", strtotime($i3class->start_time)), 'fa');
        $i3class->end_time = tr_num(date("H:i", strtotime($i3class->end_time)), 'fa');
        $i3class->course->price = tr_num($i3class->course->price,"fa");
        $i3class->course->time = tr_num($i3class->course->time , "fa");
        $i3class->start_date = tr_num($i3class->start_date , "fa");
        if (!$i3class) {
            return redirect()->back()->with([
                'message' => 'کلاس آموزشی پیدا نشد',
            ]);
        }

        return view('client.i3class', [
            'i3class' => $i3class,
        ]);
    }

    public function AddGet()
    {
        $courses = Course::orderBy('name', 'asc')->get();
        $teachers = Teacher::orderBy('name', 'asc')->get();
        $classrooms = Classroom::orderBy('name', 'asc')->get();

        return view('admin.i3class_form', [
            'courses' => $courses,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'teacher_id' => 'required',
        ]);

        $i3class = new I3class();
        $i3class->code = $request['code'];
        $i3class->course_id = $request['course_id'];
        $i3class->teacher_id = $request['teacher_id'];
        $i3class->classroom_id = $request['classroom_id'];
        $i3class->capacity = $request['capacity'];
        $i3class->start_date = $request['start_date'];
        $i3class->start_time = $request['start_time'];
        $i3class->end_time = $request['end_time'];
        $i3class->weekdays = json_encode($request['weekdays'], JSON_UNESCAPED_UNICODE);
        $i3class->save();

        return redirect('/admin/i3class')->with([
            'message' => 'کلاس آموزشی افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $i3class = I3class::find($id);
        $courses = Course::orderBy('name', 'asc')->get();
        $teachers = Teacher::orderBy('name', 'asc')->get();
        $classrooms = Classroom::orderBy('name', 'asc')->get();

        if (json_decode($i3class->weekdays, true)) {
            $i3class->weekdays = json_decode($i3class->weekdays, true);
        } else {
            $i3class->weekdays = [];
        }

        if (!$i3class) {
            return redirect('/admin/i3class')->with([
                'message' => 'کلاس آموزشی پیدا نشد',
            ]);
        }

        return view('admin.i3class_form', [
            'i3class' => $i3class,
            'courses' => $courses,
            'teachers' => $teachers,
            'classrooms' => $classrooms,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'course_id' => 'required',
            'teacher_id' => 'required',
        ]);

        $i3class = I3class::find($request['id']);
        $i3class->code = $request['code'];
        $i3class->course_id = $request['course_id'];
        $i3class->teacher_id = $request['teacher_id'];
        $i3class->classroom_id = $request['classroom_id'];
        $i3class->capacity = $request['capacity'];
        $i3class->start_date = $request['start_date'];
        $i3class->start_time = $request['start_time'];
        $i3class->end_time = $request['end_time'];
        $i3class->weekdays = json_encode($request['weekdays']);
        $i3class->update();

        return redirect('/admin/i3class')->with([
            'message' => 'کلاس آموزشی ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $i3class = I3class::find($id);

        if (!$i3class) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'کلاس آموزشی پیدا نشد',
            ]);
        }

        $i3class->delete();

        return redirect()->back()->with([
            'message' => 'کلاس آموزشی حذف شد',
        ]);
    }

    public function ChangeStateGet($state, $id)
    {
        $i3class = I3class::find($id);

        if (!$i3class) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'کلاس آموزشی پیدا نشد',
            ]);
        }

        $i3class->state = $state;
        $i3class->update();

        return redirect()->back()->with([
            'message' => 'کلاس آموزشی تغییر وضعیت داده شد',
        ]);
    }
}
