<?php

namespace App\Http\Controllers;

use App\Events\commentCreated;
use App\SocialNetwork;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class SocialNetworkController extends Controller
{
	public function AllGet()
	{
		$social_networks = SocialNetwork::all();

		return view('admin.social_networks', [
			'social_networks' => $social_networks,
		]);
	}

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120'
		]);

		$social_network = new SocialNetwork();
		$social_network->description = $request['description'];
		$social_network->name = $request['name'];
		$social_network->link = $request['link'];
		$social_network->icon = $request['icon'];
		$social_network->save();

		return redirect('/admin/social_network')->with([
			'message' => 'شبکه اجتماعی افزوده شد',
		]);
	}

	public function EditPost(Request $request)
	{
		$this->validate($request,[
			'name' => 'required|max:120',
		]);

		$social_network = SocialNetwork::find($request['id']);
        $social_network->description = $request['description'];
        $social_network->name = $request['name'];
        $social_network->link = $request['link'];
        $social_network->icon = $request['icon'];
		$social_network->update();

        return redirect('/admin/social_network')->with([
			'message' => 'شبکه اجتماعی ویرایش شد',
		]);
	}

	public function DeleteGet($id)
	{
		$social_network = SocialNetwork::find($id);

		if (!$social_network) {
            return redirect('/admin/social_network')->with([
				'message' => 'شبکه اجتماعی پیدا نشد',
			]);
		}

		$social_network->delete();

		return redirect()->back()->with([
			'message' => 'شبکه اجتماعی حذف شد',
		]);
	}
}