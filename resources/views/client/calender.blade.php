@extends('client.template')

@section('title')
    تقویم آموزشی
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        تقویم آموزشی
    </h4>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
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
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @foreach($classtimes as $time)
                                                <th scope="col" class="fit">{{ $time }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($weekdays as $weekday)
                                            <tr>
                                                <th scope="row" class="fit">{{ $weekday }}</th>
                                                @foreach($classtimes as $time)
                                                    <td class="fit">
                                                        @foreach($i3classes["value"] as $i3class)
                                                            @if(in_array($weekday, $i3class->weekdays) && $i3class->time == $time)
                                                                <a href="{{ URL::asset("/i3class/$i3class->id") }}"
                                                                   class="my-1 d-block">
                                                                    <img src="{{ URL::asset("$i3class->image") }}"
                                                                         style="height: 30px"
                                                                         alt="{{ $i3class->name }}">
                                                                    {{ $i3class->name }}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection