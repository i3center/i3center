@extends('client.template')

@section('title')کلاس های آموزشی@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        کلاس های آموزشی
    </h4>

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                @foreach($i3classes_all as $index => $i3classes)
                    <li class="nav-item">
                        <a class="nav-link {{$index == 0 ? 'active':''}}" id="pills-{{ $i3classes["name"] }}-tab"
                           data-toggle="pill" href="#pills-{{ $i3classes["name"] }}" role="tab"
                           aria-controls="pills-{{ $i3classes["name"] }}" aria-selected="true">
                            {{ $i3classes["title"] }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="tab-content" id="pills-tabContent">
                @foreach($i3classes_all as $index => $i3classes)
                    <div class="tab-pane fade {{$index == 0 ? 'show active':''}}" id="pills-{{ $i3classes["name"] }}"
                         role="tabpanel" aria-labelledby="pills-{{ $i3classes["name"] }}-tab">
                        <div class="row">
                            @foreach($i3classes["value"] as $i3class)
                                <div class="col-lg-3 col-sm-6 col-12 mb-4">

                                    @include('client.course_card')

                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection