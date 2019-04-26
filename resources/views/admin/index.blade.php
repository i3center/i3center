@extends('admin.template')

@section('title')
    مدیریت
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/blog/topic") }}"
               class="text-decoration-none">
                <div class="card text-white bg-primary mb-3 shadow rounded-lg">
                    <div class="card-header">پست های بلاگ</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $topics_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-blog fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/course") }}"
               class="text-decoration-none">
                <div class="card text-white bg-danger mb-3 shadow rounded-lg">
                    <div class="card-header">کلاس های آموزشی</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $i3classes_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-chalkboard-teacher fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/teacher") }}"
               class="text-decoration-none">
                <div class="card text-white bg-success mb-3 shadow rounded-lg">
                    <div class="card-header">استادها</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $teachers_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-user fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/student") }}"
               class="text-decoration-none">
                <div class="card text-white bg-warning mb-3 shadow rounded-lg">
                    <div class="card-header">دانشجویان</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $students_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-user-graduate fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/slider") }}"
               class="text-decoration-none">
                <div class="card text-white bg-secondary mb-3 shadow rounded-lg">
                    <div class="card-header">اسلایدر</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $sliders_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-images fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/i3class") }}"
               class="text-decoration-none">
                <div class="card text-dark bg-light mb-3 shadow rounded-lg">
                    <div class="card-header">کلاس های ICDL</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $icdl_i3classes_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-chalkboard-teacher fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/icdl/test") }}"
               class="text-decoration-none">
                <div class="card text-white bg-dark mb-3 shadow rounded-lg">
                    <div class="card-header">آزمون های ICDL</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $icdl_test_number }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-desktop fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6">
            <a href="{{ URL::asset("/admin/message") }}"
               class="text-decoration-none">
                <div class="card text-white bg-info mb-3 shadow rounded-lg">
                    <div class="card-header">پیام های تازه</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    {{ $new_messages_count }}
                                </h1>
                            </div>
                            <div class="col-6">
                                <h1 class="card-title text-center mb-0">
                                    <i class="fas fa-envelope fa-fw"></i>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection

