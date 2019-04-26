<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Course;
use App\IcdlTest;
use App\Information;
use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IcdlTestController extends Controller
{
    public function AllGetForAdmin()
    {
        $icdl_test_number = Information::where('name', '=', 'icdl_test_number')->firstOrFail();
        $icdl_test_date = Information::where('name', '=', 'icdl_test_date')->firstOrFail();

        $courses = Course::select('courses.*')
            ->join('groups', 'groups.id', '=', 'courses.group_id')
            ->where('groups.name', '=', 'ICDL')
            ->get();

        $icdl_test_times = json_decode(Setting::where('name', '=', 'icdl_test_times')->firstOrFail()->value, true);

        $icdl_tests = array();

        for ($i = 1; $i <= 10; $i++) {
            foreach ($icdl_test_times as $t => $time) {
                $icdl_test = IcdlTest::select()
                    ->where('system_id', '=', $i)
                    ->where('time', '=', $time)
                    ->first();

                if ($icdl_test) {
                    $icdl_tests["student_name"][$i][$t] = $icdl_test->student_name;
                    $icdl_tests["course_id"][$i][$t] = $icdl_test->course_id;
                }
            }
        }

        return view('admin.icdl_tests', [
            'courses' => $courses,
            'icdl_tests' => $icdl_tests,
            'icdl_test_number' => $icdl_test_number,
            'icdl_test_date' => $icdl_test_date,
            'icdl_test_times' => $icdl_test_times,
        ]);
    }

    public function EditPost(Request $request)
    {
        $icdl_test_number = Information::where('name', '=', 'icdl_test_number')->firstOrFail();
        $icdl_test_number->value = $request['icdl_test_number'];
        $icdl_test_number->save();

        $icdl_test_date = Information::where('name', '=', 'icdl_test_date')->firstOrFail();
        $icdl_test_date->value = $request['icdl_test_date'];
        $icdl_test_date->save();

        $icdl_test_times = json_decode(Setting::where('name', '=', 'icdl_test_times')->firstOrFail()->value, true);

        for ($i = 1; $i <= 10; $i++) {
            foreach ($icdl_test_times as $t => $time) {
                $icdl_test = IcdlTest::select()
                    ->where('system_id', '=', $i)
                    ->where('time', '=', $time)
                    ->first();

                if ($icdl_test) {
                    $icdl_test->student_name = $request['student_name'][$i][$t];
                    $icdl_test->course_id = $request['course_id'][$i][$t];
                    $icdl_test->update();
                } else if ($request['student_name'][$i][$t] != '' && $request['course_id'][$i][$t] != '') {
                    $icdl_test = new IcdlTest();
                    $icdl_test->student_name = $request['student_name'][$i][$t];
                    $icdl_test->course_id = $request['course_id'][$i][$t];
                    $icdl_test->system_id = $i;
                    $icdl_test->time = $time;
                    $icdl_test->save();
                }
            }
        }

        return redirect('/admin/icdl/test')->with([
            'message' => 'آزمون ICDL ویرایش شد',
        ]);
    }
}
