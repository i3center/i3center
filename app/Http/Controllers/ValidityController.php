<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\Validity;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ValidityController extends Controller
{
    public function AllGet()
    {
        $validities = Validity::all();

        return view('admin.validities', [
            'validities' => $validities,
        ]);
    }

    public function AddGet()
    {
        return view('admin.validity_form');
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'caption' => 'max:120',
        ]);

        $validity = new Validity();
        $validity->caption = $request['caption'];
        $validity->image = $request['image'];
        $validity->save();

        return redirect('admin/validity')->with([
            'message' => 'اعتبار افزوده شد',
        ]);
    }

    public function EditGet($id)
    {
        $validity = Validity::find($id);

        if (!$validity) {
            return redirect('admin/validity')->with([
                'message' => 'اعتبار پیدا نشد',
            ]);
        }

        return view('admin.validity_form', [
            'validity' => $validity,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'caption' => 'max:120',
        ]);

        $validity = Validity::find($request['id']);
        $validity->caption = $request['caption'];
        $validity->image = $request['image'];
        $validity->update();

        return redirect('admin/validity')->with([
            'message' => 'اعتبار ویرایش شد',
        ]);
    }

    public function DeleteGet($id)
    {
        $validity = Validity::find($id);

        if (!$validity) {
            return redirect('admin/validity')->with([
                'message' => 'اعتبار پیدا نشد',
            ]);
        }

        $validity->delete();

        return redirect()->back()->with([
            'message' => 'اعتبار حذف شد',
        ]);
    }
}
