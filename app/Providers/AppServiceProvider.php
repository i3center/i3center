<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Menu;
use App\Logo;
use App\SocialNetwork;
use App\Information;
use App\Setting;
use App\Category;

include app_path() . '/jdf.php';

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $weekdays = json_decode(Setting::where('name', '=', 'week_days')->firstOrFail()->value, true);

        $classtimes = json_decode(Setting::where('name', '=', 'class_times')->firstOrFail()->value, true);

        $dictionary = array('blog' => 'بلاگ',
            'education' => 'آموزشی',
            'fun' => 'جشن',
            'job' => 'فرصت شغلی',
            'technology' => 'فناوری',
            'teacher' => 'استاد',
            'student' => 'دانشجو',
            'calender' => 'تقویم آموزشی',
            'course' => 'دوره تخصصی',
            'i3class' => 'کلاس آموزشی',
            'regulation' => 'آیین نامه',
            'about' => 'درباره ما',
            'contact' => 'مشاوره و تماس',
            'i3class' => 'کلاس آموزشی',
        );

        // head info

        $description = Information::where('name', '=', 'description')->firstOrFail()->value;
        $keywords = Information::where('name', '=', 'keywords')->firstOrFail()->value;

        // header info

        $menus = Menu::where('parent_id', '=', '0')->orderBy('order', 'asc')->get();

        // footer info

        $logos = Logo::all();
        $social_networks = SocialNetwork::all();

        $phone_number = tr_num(Information::where('name', '=', 'phone_number')->firstOrFail()->value, 'fa');
        $phone_number2 = tr_num(Information::where('name', '=', 'phone_number2')->firstOrFail()->value, 'fa');
        $email = Information::where('name', '=', 'email')->firstOrFail()->value;
        $work_time = tr_num(Information::where('name', '=', 'work_time')->firstOrFail()->value, 'fa');
        $address = tr_num(Information::where('name', '=', 'address')->firstOrFail()->value, 'fa');

        $categories = Category::orderBy('name', 'desc')->take(4)->get();

        View::share('menus', $menus);
        View::share('logos', $logos);
        View::share('social_networks', $social_networks);
        View::share('phone_number', $phone_number);
        View::share('phone_number2', $phone_number2);
        View::share('email', $email);
        View::share('work_time', $work_time);
        View::share('address', $address);
        View::share('footer_categories', $categories);
        View::share('weekdays', $weekdays);
        View::share('classtimes', $classtimes);
        View::share('dictionary', $dictionary);
        View::share('description', $description);
        View::share('keywords', $keywords);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
