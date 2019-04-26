@extends('client.template')

@section('title')
    نتایج جستجو
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        نتایج جستجو
    </h4>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
                    @if(count($courses) != 0)
                        <h6 class="card-title">دوره ها</h6>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover border mb-0">
                                <tbody id="myTable">
                                @foreach($courses as $course)
                                    <tr>
                                        <td class="align-middle fit">
                                            <img class="rounded" width="50px" alt="{{$course->name}}"
                                                 src="{{ URL::asset($course->image) }}">
                                        </td>
                                        <th class="align-middle fit">
                                            <a href="{{ URL::asset("/course/$course->id") }}" class="text-danger">
                                                {{$course->name}}
                                            </a>
                                        </th>
                                        <td class="align-middle fit">{{$course->group->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <br>
                    @if(count($teachers) != 0)
                        <h6 class="card-title">استاد ها</h6>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover border mb-0">
                                <tbody id="myTable">
                                @foreach($teachers as $teacher)
                                    <tr>
                                        <td class="align-middle fit">
                                            <img class="rounded" width="50px" alt="{{$teacher->name}}"
                                                 src="{{ URL::asset($teacher->image) }}">
                                        </td>
                                        <th class="align-middle fit">
                                            <a href="{{ URL::asset("/teacher/$teacher->id") }}" class="text-danger">
                                                {{$teacher->name}}
                                            </a>
                                        </th>
                                        <td class="align-middle fit">{{$teacher->description}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <br>
                    @if(count($topics) != 0)
                        <h6 class="card-title">بلاگ</h6>
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover border mb-0">
                                <tbody id="myTable">
                                @foreach($topics as $topic)
                                    <tr>
                                        <td class="align-middle fit">
                                            <img class="rounded" width="50px" alt="{{$topic->title}}"
                                                 src="{{ URL::asset($topic->image) }}">
                                        </td>
                                        <th class="align-middle fit">
                                            <a href="{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}"
                                               class="text-danger">
                                                {{$topic->title}}
                                            </a>
                                        </th>
                                        <td class="align-middle fit">{{$topic->category->description}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection