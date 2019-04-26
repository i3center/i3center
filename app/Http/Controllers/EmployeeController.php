<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Employee;
use App\Degree;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function AllGetForAdmin()
    {
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('admin.employees', [
            'employees' => $employees,
        ]);
    }

    public function AllGetForClient()
    {
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('client.employees', [
            'employees' => $employees,
        ]);
    }

    public function SingleGet($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->back()->with([
                'message' => 'کارمند پیدا نشد',
            ]);
        }

        return view('client.employee', [
            'employee' => $employee,
        ]);
    }

    public function AddGet()
    {
        return view('admin.employee_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
        ]);

        $employee = new Employee();
        $employee->name = $request['name'];
        $employee->national_code = $request['national_code'];
        $employee->birth_date = $request['birth_date'];
        $employee->explanation = $request['explanation'];
        $employee->email = $request['email'];
        $employee->telegram = $request['telegram'];
        $employee->instagram = $request['instagram'];
        $employee->image = $request['image'];
        $employee->save();

        return redirect('/admin/employee')->with([
            'message' => 'کارمند افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $employee = Employee::find($id);
        $degrees = Degree::orderBy('name', 'desc')->get();

        if (!$employee) {
            return redirect('/admin/employee')->with([
                'message' => 'کارمند پیدا نشد',
            ]);
        }

        return view('admin.employee_form', [
            'employee' => $employee,
            'degrees' => $degrees,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120',
            'email' => 'required|email',
        ]);

        $employee = Employee::find($request['id']);

        $employee->name = $request['name'];
        $employee->national_code = $request['national_code'];
        $employee->birth_date = $request['birth_date'];
        $employee->explanation = $request['explanation'];
        $employee->email = $request['email'];
        $employee->telegram = $request['telegram'];
        $employee->instagram = $request['instagram'];
        $employee->image = $request['image'];

        $employee->update();

        return redirect('/admin/employee')->with([
            'message' => 'کارمند ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $employee = Employee::find($topic_id);

        if (!$employee) {
            return redirect('/admin/employee')->with([
                'message' => 'کارمند پیدا نشد',
            ]);
        }

        $employee->delete();

        return redirect()->back()->with([
            'message' => 'کارمند حذف شد',
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
