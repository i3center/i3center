<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Slider;
use App\Image;
use App\Course;
use App\I3class;
use App\IcdlTest;
use App\Teacher;
use App\Topic;
use App\Category;
use App\Information;
use App\Setting;
use App\Employee;
use App\Validity;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function Index()
    {
        $sliders = Slider::orderBy('order', 'asc')->get();
        $images = Image::all();

        $i3classes = I3class::select('i3classes.*')->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '<>', 'ICDL')
            ->orderBy('state', 'asc')
            ->orderBy('i3classes.created_at', 'desc')
            ->take(3)->get();

        $topics = Topic::orderBy('created_at', 'desc')->take(4)->get();

        foreach ($i3classes as $i3class) {
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
        foreach ($topics as $topic) {

            $topic->body = preg_replace("/&nbsp;/",'', strip_tags($this->shortenText($topic->body, 20)));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('client.index', [
            'sliders' => $sliders,
            'images' => $images,
            'i3classes' => $i3classes,
            'topics' => $topics,
        ]);
    }

    public function About()
    {
        $about = Information::where('name', '=', 'about')->firstOrFail();
        $validities = Validity::all();

        $employees = Employee::all();

        return view('client.about', [
            'about' => $about,
            'validities' => $validities,
            'employees' => $employees,
        ]);
    }

    public function ICDL()
    {
        // ICDL Class

        $i3classes = I3class::select('i3classes.*', 'courses.name', 'courses.explanation', 'courses.image', 'teachers.name AS teacher_name', 'groups.name AS group_name', 'classrooms.name AS classroom_name')
            ->join('classrooms', 'classrooms.id', '=', 'i3classes.classroom_id')
            ->join('teachers', 'teachers.id', '=', 'i3classes.teacher_id')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '=', 'ICDL')
            ->orderBy('state', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        foreach ($i3classes as $i3class) {
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

        // ICDL Test

        $icdl_test_number = Information::where('name', '=', 'icdl_test_number')->firstOrFail();
        $icdl_test_date = Information::where('name', '=', 'icdl_test_date')->firstOrFail();

        $icdl_test_number = tr_num($icdl_test_number->value, 'fa');
        $icdl_test_date = tr_num($icdl_test_date->value, 'fa');

        $icdl_test_times = json_decode(Setting::where('name', '=', 'icdl_test_times')->firstOrFail()->value, true);

        $icdl_tests = array();

        for($i = 1; $i <= 10; $i++)
        {
            foreach($icdl_test_times as $t => $time)
            {
                $icdl_test = IcdlTest::select('icdl_tests.*', 'courses.name AS course_name')
                    ->join('courses', 'courses.id', '=', 'icdl_tests.course_id')
                    ->where('system_id','=', $i)
                    ->where('icdl_tests.time','=', $time)
                    ->first();

                if($icdl_test)
                {
                    $icdl_tests["student_name"][$i][$t] = $icdl_test->student_name;
                    $icdl_tests["course_name"][$i][$t] = $icdl_test->course_name;
                }
            }
        }

        return view('client.icdl', [
            'i3classes' => $i3classes,
            'icdl_tests' => $icdl_tests,
            'icdl_test_number' => $icdl_test_number,
            'icdl_test_date' => $icdl_test_date,
            'icdl_test_times' => $icdl_test_times,
        ]);
    }

    public function Calender()
    {
        $i3classes_new = I3class::select('i3classes.*', 'courses.name', 'courses.explanation', 'courses.image', 'teachers.name AS teacher_name', 'groups.name AS group_name', 'classrooms.name AS classroom_name')
            ->join('classrooms', 'classrooms.id', '=', 'i3classes.classroom_id')
            ->join('teachers', 'teachers.id', '=', 'i3classes.teacher_id')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('state', '=', '1')
            ->orderBy('state', 'desc')->get();

        $i3classes_current = I3class::select('i3classes.*', 'courses.name', 'courses.explanation', 'courses.image', 'teachers.name AS teacher_name', 'groups.name AS group_name', 'classrooms.name AS classroom_name')
            ->join('classrooms', 'classrooms.id', '=', 'i3classes.classroom_id')
            ->join('teachers', 'teachers.id', '=', 'i3classes.teacher_id')
            ->join('courses', 'courses.id', '=', 'i3classes.course_id')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('state', '=', '2')
            ->orderBy('state', 'desc')->get();

        $i3classes_all = array(
            array('title' => 'در حال ثبت نام', 'name' => 'new', 'value' => $i3classes_new),
            array('title' => 'در حال برگزاری', 'name' => 'current', 'value' => $i3classes_current)
        );

        foreach ($i3classes_all as $i3classes) {
            foreach ($i3classes["value"] as $i3class) {
                if (json_decode($i3class->weekdays, true)) {
                    $i3class->weekdays = json_decode($i3class->weekdays, true);
                } else {
                    $i3class->weekdays = [];
                }

                $i3class->capacity = tr_num($i3class->capacity, 'fa');
                $i3class->start_date = tr_num($i3class->start_date, 'fa');
                $i3class->time = date("H:i", strtotime($i3class->start_time)) . ' - ' . date("H:i", strtotime($i3class->end_time));
            }
        }

        return view('client.calender', [
            'i3classes_all' => $i3classes_all,
        ]);
    }

    public function InternationalTestTour()
    {
        $internationalـtestـtour = Information::where('name', '=', 'international test tour')->firstOrFail();

        return view('client.international-test-tour', [
            'internationalـtestـtour' => $internationalـtestـtour,
        ]);
    }

    public function Search(Request $request)
    {
        $text = $request['text'];

        $topics = Topic::where('title','like',"%$text%")
            ->orWhere('body','like',"%$text%")
            ->orWhere('description','like',"%$text%")
            ->orWhere('keywords','like',"%$text%")
            ->orderBy('created_at', 'desc')->get();

        $courses = Course::where('name','like',"%$text%")
            ->orWhere('explanation','like',"%$text%")
            ->orWhere('description','like',"%$text%")
            ->orWhere('keywords','like',"%$text%")
            ->orderBy('name', 'asc')->get();

        $teachers = Teacher::where('name','like',"%$text%")
            ->orWhere('explanation','like',"%$text%")
            ->orWhere('description','like',"%$text%")
            ->orWhere('keywords','like',"%$text%")
            ->orderBy('name', 'asc')->get();

        return view('client.search', [
            'topics' => $topics,
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }

    private function shortenText($text, $len)
    {
        $words = explode(' ', $text);
        if (count($words) > $len) {
            $words = array_slice($words, 0, $len);
            $text = join(" ", $words) . " ...";
        }
        return $text;
    }
}