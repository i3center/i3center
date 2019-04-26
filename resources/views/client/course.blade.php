@extends('client.template')

@section('title'){{$course->name}}@endsection

@section('description'){{$course->description}}@endsection

@section('keywords'){{$course->keywords}}@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card testimonial-card shadow-sm rounded border-0">
                <div class="view-cascade">
                    <img class="img-fluid rounded-top card-img-top-course-bg"
                         src="{{ URL::asset("/photos/1/image/slider1.jpg") }}"
                         alt="i3center class cover">
                </div>
                <div class="avatar mx-auto bg-light shadow p-3">
                    <img src="{{ URL::asset($course->image) }}" alt="{{$course->name}}">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$course->name}}</h4>
                    <hr>
                    <p>
                        {{$course->description}}
                    </p>
                    <div class="text-justify">
                        {!! $course->explanation !!}
                    </div>
                </div>
            </div>
            <br>
            <h5 class="text-right mb-3">کلاس های آموزشی:</h5>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        @foreach($i3classes_all as $index => $i3classes)
                            <li class="nav-item">
                                <a class="nav-link {{$index == 0 ? 'active':''}}"
                                   id="pills-{{ $i3classes["name"] }}-tab" data-toggle="pill"
                                   href="#pills-{{ $i3classes["name"] }}"
                                   role="tab" aria-controls="pills-{{ $i3classes["name"] }}" aria-selected="true">
                                    {{ $i3classes["title"] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach($i3classes_all as $index => $i3classes)
                            <div class="tab-pane fade {{$index == 0 ? 'show active':''}}"
                                 id="pills-{{ $i3classes["name"] }}" role="tabpanel"
                                 aria-labelledby="pills-{{ $i3classes["name"] }}-tab">

                                <div class="row">
                                    @foreach($i3classes["value"] as $i3class)
                                        <div class="col-lg-3 col-sm-6 col-12 mb-4">
                                            <a href="{{ URL::asset("/i3class/$i3class->id") }}"
                                               class="text-dark text-decoration-none">
                                                <div class="card shadow-sm border-0 rounded text-center p-3 h-100 hover-danger bg-white">
                                                    <img src="{{ URL::asset($i3class->course->image) }}"
                                                         class="img-fluid rounded mx-auto w-25 hover-image"
                                                         alt="{{$i3class->course->name}}">
                                                    <div class="card-body p-0">
                                                        <h5 class="card-title mt-3">{{$i3class->course->name}}</h5>
                                                        <p class="card-text text-wrap">
                                                            {{ $i3class->course->description }}
                                                        </p>
                                                    </div>
                                                    <div class="card-footer border-0 bg-transparent p-0 mt-2">
                                                        <ul class="list-unstyled text-right mb-0">
                                                            <li>
                                                                <small>
                                                                    <i class="fas fa-user fa-fw text-danger"></i>
                                                                    {{$i3class->teacher->name}}
                                                                </small>
                                                            </li>
                                                            <li>
                                                                <small>
                                                                    <i class="fas fa-calendar-check fa-fw text-danger"></i>
                                                                    از {{$i3class->start_date}}
                                                                </small>
                                                            </li>
                                                            <li>
                                                                <small>
                                                                    <i class="fas fa-calendar-week fa-fw text-danger"></i>
                                                                    {{$i3class->weekdays}}
                                                                </small>
                                                            </li>
                                                            <li>
                                                                <small>
                                                                    <i class="fas fa-clock fa-fw text-danger"></i>
                                                                    {{$i3class->start_time}}
                                                                    تا
                                                                    {{$i3class->end_time}}
                                                                </small>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
