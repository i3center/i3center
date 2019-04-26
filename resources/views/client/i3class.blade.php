@extends('client.template')

@section('title'){{$i3class->course->name}}@endsection

@section('description'){{$i3class->course->description}}@endsection

@section('keywords'){{$i3class->course->keywords}}@endsection

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card testimonial-card shadow-sm rounded border-0">
                <div class="view-cascade">
                    <img class="img-fluid rounded-top card-img-top-course-bg"
                         src="{{ URL::asset("/photos/1/image/slider1.jpg") }}"
                         alt="i3center class cover">
                </div>
                <div class="avatar mx-auto bg-light shadow p-1">
                    <img src="{{ URL::asset($i3class->course->image) }}" alt="{{$i3class->course->name}}">
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{$i3class->course->name}}</h4>
                    <hr>
                    <p>{{$i3class->course->description}}</p>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <ul class="list-group  text-right ">
                                <li class="list-group-item  active  p-3 ">
                                    اطلاعات
                                </li>
                                <li class="list-group-item  list-group-item-action p-3">
                                    <i class="fas fa-user fa-fw"></i>
                                    استاد:
                                    <a href="{{ URL::asset("/teacher/" . $i3class->teacher->id) }}">
                                        {{ $i3class->teacher->name }}
                                    </a>
                                </li>
                                <li class="list-group-item  list-group-item-action  p-3">
                                    <i class="fas fa-calendar-check fa-fw "></i>
                                    از
                                    {{ $i3class->start_date }}
                                </li>
                                <li class="list-group-item  list-group-item-action  p-3">
                                    <i class="fas fa-calendar fa-fw"></i> {{$i3class->weekdays}}
                                </li>
                                <li class="list-group-item  list-group-item-action  p-3">
                                    <i class="fas fa-clock fa-fw"></i>
                                    {{$i3class->start_time}}
                                    تا
                                    {{$i3class->end_time}}
                                </li>
                                <li class="list-group-item  list-group-item-action  p-3">
                                    <i class="fas fa-hourglass-half fa-fw"></i> {{$i3class->course->time}}
                                    ساعت
                                </li>
                                <li class="list-group-item  list-group-item-action  p-3">
                                    <i class="fas fa-coins fa-fw"></i> {{$i3class->course->price}}
                                    تومان
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="text-justify">
                                {!! $i3class->course->explanation !!}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection