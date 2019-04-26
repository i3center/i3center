<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Events\commentCreated;
use App\Topic;
use App\Category;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Storage;
use File;

class TopicController extends Controller
{
    public function AllGetForAdmin()
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(20);

        foreach ($topics as $topic) {

            $topic->created_time = jdate('H:i:s', strtotime($topic->created_at));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('admin.blog.topics', [
            'topics' => $topics,
        ]);
    }

    public function AllGetForClient()
    {
        $topics = Topic::orderBy('created_at', 'desc')->paginate(12);

        foreach ($topics as $topic) {

            $topic->body = preg_replace("/&nbsp;/",'', strip_tags($this->shortenText($topic->body, 20)));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('client.blog.topics', [
            'topics' => $topics,
        ]);
    }

    public function ByCategoryGet($category)
    {
        $topics = Topic::select('topics.*')
            ->join('categories', 'categories.id', '=', 'topics.category_id')
            ->where('categories.name', '=', $category)
            ->orderBy('created_at', 'desc')->paginate(10);

        foreach ($topics as $topic) {

            $topic->body = preg_replace("/&nbsp;/",'', strip_tags($this->shortenText($topic->body, 20)));
            $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));
        }

        return view('client.blog.topics', [
            'topics' => $topics,
        ]);
    }

    public function SingleGet($category, $id)
    {
        $topic = Topic::find($id);

        if (!$topic) {
            return redirect('/blog')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        $topic->created_date = jdate('l j F Y', strtotime($topic->created_at));

        return view('client.blog.topic', [
            'topic' => $topic,
        ]);
    }

    public function AddGet()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        return view('admin.blog.topic_form', [
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    public function AddPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'body' => 'required',
            'description' => 'required|max:128',
            'keywords' => 'required|max:128',
        ]);

        $topic = new Topic();
        $topic->title = $request['title'];
        $topic->body = $request['body'];
        $topic->category_id = $request['category_id'];
        $topic->employee_id = $request['employee_id'];
        $topic->description = $request['description'];
        $topic->keywords = $request['keywords'];
        $topic->image = $request['image'];
        $topic->save();

        return redirect('admin/blog/topic')->with([
            'message' => 'پست درج شد',
        ]);
    }

    public function EditGet($topic_id)
    {
        $topic = Topic::find($topic_id);

        $categories = Category::orderBy('name', 'desc')->get();
        $employees = Employee::orderBy('name', 'asc')->get();

        if (!$topic) {
            return redirect('admin/blog/topic')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        return view('admin.blog.topic_form', [
            'topic' => $topic,
            'categories' => $categories,
            'employees' => $employees,
        ]);
    }

    public function EditPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:120',
            'body' => 'required',
            'description' => 'required|max:128',
            'keywords' => 'required|max:128',
        ]);

        $topic = Topic::find($request['id']);
        $topic->title = $request['title'];
        $topic->body = $request['body'];
        $topic->category_id = $request['category_id'];
        $topic->employee_id = $request['employee_id'];
        $topic->description = $request['description'];
        $topic->keywords = $request['keywords'];
        $topic->image = $request['image'];
        $topic->update();

        return redirect('/admin/blog/topic')->with([
            'message' => 'پست ویرایش شد',
        ]);
    }

    public function DeleteGet($topic_id)
    {
        $topic = Topic::find($topic_id);

        if (!$topic) {
            return redirect()->route('admin.blog.topics.get')->with([
                'message' => 'پست پیدا نشد',
            ]);
        }

        $topic->delete();

        return redirect()->back()->with([
            'message' => 'پست حذف شد',
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