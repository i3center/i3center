<header class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow py-0 border-bottom-0 navbar-client">
        <a class="navbar-brand py-2" href="{{ URL::asset("/") }}" style="width: 160px;">
            <img src="{{ URL::asset("/photos/1/i3center-logo.png") }}" class="w-100" alt="i3center logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto main-menu-list" id="nav-main-menu">
                @foreach($menus as $menu)
                    <li class="nav-item {{isset($menu->submenus) && count($menu->submenus) > 0 ? 'dropdown' : ''}} {{Request::is($menu->link) ? 'active' : ''}}">
                        <a class="nav-link {{isset($menu->submenus) && count($menu->submenus) ? 'dropdown-toggle' : ''}} text-center pb-1"
                           href="{{ URL::asset("/$menu->link") }}"
                                {{ count($menu->childs) ? 'id=navbarDropdown role=button
                                data-toggle=dropdown aria-haspopup=true aria-expanded=false' : ''}}>
                            <span class="{{$menu->icon}}"></span>
                            <span class="d-lg-block">{{$menu->title}}</span>
                        </a>

                        @if(count($menu->childs) > 0)
                            <div class="dropdown-menu text-dark shadow border-0 rounded-bottom mt-1"
                                 aria-labelledby="navbarDropdown">
                                @foreach($menu->childs()->orderBy('order', 'asc')->get() as $submenu)
                                    <a class="dropdown-item"
                                       href="{{ URL::asset("/$submenu->link") }}">{{$submenu->title}}</a>
                                @endforeach
                            </div>
                        @endif
                    </li>
                @endforeach

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-center pb-0" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user fa-2x fa-fw"></i>
                        <span class="d-lg-block">ورود</span>
                    </a>
                    <div class="dropdown-menu text-dark shadow border-0 rounded-bottom mt-1"
                         aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            پورتال استاد
                            <small>(به زودی)</small>
                        </a>
                        <a class="dropdown-item" href="#">
                            پورتال دانشجو
                            <small>(به زودی)</small>
                        </a>
                    </div>
                </li>
            </ul>
            <form class="my-2 my-lg-0 float-left form-inline mr-3" id="nav-search-form" method="post"
                  action="{{ URL::asset("/search") }}">
                <input class="form-control ml-0 mr-sm-2 w-100 pr-5" id="nav-search-input" type="search" name="text"
                       aria-label="Search">
                <i class="fas fa-search fa-lg fa-fw mr-2 text-danger" id="nav-search-icon"></i>
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
            </form>
        </div>
    </nav>
</header>