<?php

namespace App\Http\Controllers;

use App\Message;
use App\Information;
use App\SocialNetwork;
use App\Events\commentCreated;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;

class MessageController extends Controller
{
	public function Index()
	{
        $contact = Information::where('name', '=', 'contact')->firstOrFail();
        $address_full = Information::where('name', '=', 'address_full')->firstOrFail()->value;
        $telegram = SocialNetwork::where('description', '=', 'تلگرام کارشناسان آموزش')->firstOrFail()->link;

		return view('client.contact', [
            'contact' => $contact,
            'address_full' => $address_full,
            'telegram' => $telegram,
        ]);
	}

    public function AllGet()
    {
        $messages_for_show = Message::orderBy('created_at', 'desc')->paginate(20);

        $messages = Message::orderBy('created_at', 'desc')->paginate(20);

        foreach ($messages as $message)
        {
            $message->new = 0;
            $message->save();
        }

        return view('admin.messages', [
            'messages' => $messages_for_show
        ]);
    }

	public function AddPost(Request $request)
	{
		$this->validate($request,[
			'sender' => 'required|max:64',
			'body' => 'required|max:256',
			'email' => 'required'
		]);

		$message = new Message();
        $message->sender = $request['sender'];
        $message->email = $request['email'];
        $message->subject = $request['subject'];
        $message->body = $request['body'];
        $message->save();

		return redirect()->back()->with([
			'message' => 'پیام شما فرستاده شد',
		]);
	}

	public function DeleteGet($id)
	{
        $message = Message::find($id);
        $message->delete();

        return redirect()->back()->with([
			'message' => 'پیام حذف شد',
		]);
	}
}
