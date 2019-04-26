<div class="nav flex-column h-100" id="aside-admin">
    <a class="btn rounded" href="{{ URL::asset("/") }}" data-toggle="tooltip" data-placement="bottom"
       title="خانه">
        <img src="{{ URL::asset("/photos/1/logo-red.png") }}" class="img-fluid" alt="i3center logo">
    </a>
    <div class="dropdown-divider"></div>
    <a class="btn btn-outline-secondary btn-sm mb-2" href="{{ URL::asset("/admin/logout") }}">
        <span class="fas fa-sign-out-alt fa-fw"></span>
        خروج
    </a>
    <a class="btn btn-danger btn-sm text-right mb-1" href="{{ URL::asset("/admin") }}">
        <span class="fas fa-th fa-fw"></span>
        مدیریت
    </a>
    <div class="card bg-transparent border-0 my-1">
        <button class="btn btn-danger btn-sm text-right" type="button" data-toggle="collapse" data-target="#collapseOne"
                aria-expanded="true" aria-controls="collapseOne">
            <span class="fas fa-blog fa-fw"></span>
            بلاگ
        </button>
        <div id="collapseOne" class="collapse show p-0" aria-labelledby="headingOne"
             data-parent="#accordionExample">
            <div class="card-body p-0 py-1">
                <a class="nav-link {{Request::is('admin/blog/topic*')?'text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/blog/topic") }}">
                    <span class="fas fa-th-list fa-fw"></span>
                    پست ها
                </a>
                <a class="nav-link {{Request::is('admin/blog/category*')?'text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/blog/category") }}">
                    <span class="fas fa-shapes fa-fw"></span>
                    دسته بندی ها
                </a>
            </div>
        </div>
    </div>
    <div class="card bg-transparent border-0 my-1">
        <button class="btn btn-danger btn-sm text-right" type="button" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="false" aria-controls="collapseTwo">
            <span class="fas fa-book-open fa-fw"></span>
            آموزش
        </button>
        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body p-0 py-1">
                <a class="nav-link {{Request::is('admin/course*')?'bg-light text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/course") }}">
                    <span class="fas fa-book fa-fw"></span>
                    دوره های تخصصی
                </a>
                <a class="nav-link {{Request::is('admin/i3class*')?'bg-light text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/i3class") }}">
                    <span class="fas fa-chalkboard-teacher fa-fw"></span>
                    کلاس های آموزشی
                </a>
                <a class="nav-link {{Request::is('admin/icdl/test*')?'bg-light text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/icdl/test") }}">
                    <span class="fas fa-desktop fa-fw"></span>
                    آزمون های ICDL
                </a>
                <a class="nav-link {{Request::is('admin/group*')?'bg-light text-danger':'text-dark'}}"
                   href="{{ URL::asset("/admin/group") }}">
                    <span class="fas fa-layer-group fa-fw"></span>
                    گروه ها
                </a>
                <a class="nav-link {{Request::is('admin/teacher*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/teacher") }}">
                    <span class="fas fa-user fa-fw"></span>
                    اساتید
                </a>
                <a class="nav-link {{Request::is('admin/student*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/student") }}">
                    <span class="fas fa-user-graduate fa-fw"></span>
                    دانشجویان
                </a>
                <a class="nav-link {{Request::is('admin/test*')?'text-danger rounded-lg':'text-dark'}}"
                   href="#">
                    <span class="far fa-check-square fa-fw"></span>
                    آزمون ها
                </a>
                <a class="nav-link {{Request::is('admin/degree*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/degree") }}">
                    <span class="fas fa-graduation-cap"></span>
                    تحصیلات
                </a>
                <a class="nav-link {{Request::is('admin/classroom*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/classroom") }}">
                    <span class="fas fa-chalkboard fa-fw"></span>
                    کلاس ها
                </a>
                <a class="nav-link {{Request::is('admin/off*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/off") }}">
                    <span class="fas fa-dollar-sign fa-fw"></span>
                    تخفیف ها
                </a>
            </div>
        </div>
    </div>
    <div class="card bg-transparent border-0 my-1">

        <button class="btn btn-danger btn-sm text-right" type="button" data-toggle="collapse"
                data-target="#collapseThree"
                aria-expanded="false" aria-controls="collapseThree">
            <span class="fas fa-cog fa-fw fa-spin"></span>
            وبسایت
        </button>

        <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body p-0 py-1">
                <a class="nav-link {{Request::is('admin/employee*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/employee") }}">
                    <span class="fas fa-user-tie fa-fw"></span>
                    همکاران
                </a>
                <a class="nav-link {{Request::is('admin/information*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/information") }}">
                    <span class="fas fa-info fa-fw"></span>
                    اطلاعات
                </a>
                <a class="nav-link {{Request::is('admin/regulation*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/regulation") }}">
                    <span class="fas fa-scroll fa-fw"></span>
                    آیین نامه ها
                </a>
                <a class="nav-link {{Request::is('admin/menu*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/menu") }}">
                    <span class="fas fa-ellipsis-h fa-fw"></span>
                    منو
                </a>
                <a class="nav-link {{Request::is('admin/social_network*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/social_network") }}">
                    <span class="fas fa-network-wired fa-fw"></span>
                    شبکه های اجتماعی
                </a>
                <a class="nav-link {{Request::is('admin/validity*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/validity") }}">
                    <span class="fas fa-images fa-fw"></span>
                    اعتبارها
                </a>
                <a class="nav-link {{Request::is('admin/slider*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/slider") }}">
                    <span class="fas fa-images fa-fw"></span>
                    اسلایدر
                </a>
                <a class="nav-link {{Request::is('admin/image*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/image") }}">
                    <span class="fas fa-image fa-fw"></span>
                    نمایه ها
                </a>
                <a class="nav-link {{Request::is('admin/message*')?'text-danger rounded-lg':'text-dark'}}"
                   href="{{ URL::asset("/admin/message") }}">
                    <span class="fas fa-envelope fa-fw"></span>
                    پیام ها
                </a>
            </div>
        </div>
    </div>
</div>