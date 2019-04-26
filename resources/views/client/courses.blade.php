@extends('client.template')

@section('title')
    دوره های تخصصی
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        دوره های تخصصی
    </h4>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($courses) == 0)
                        <h5 class="card-title">دوره ای وجود ندارد</h5>
                    @else
                        <div class="table-responsive-sm">
                            <table class="table table-striped table-hover border mb-0">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">نام</th>
                                    <th scope="col" class="d-none d-sm-none d-md-table-cell">توصیف</th>
                                    <th scope="col">گروه</th>
                                    <th scope="col">مدت</th>
                                    <th scope="col" class="fit">هزینه</th>
                                    <th scope="col" class="fit">پیش ثبت نام</th>
                                </tr>
                                </thead>
                                <tbody id="myTable">
                                @foreach($courses as $course)
                                    <tr>
                                        <td class="align-middle fit">
                                            <img class="rounded" width="50px"
                                                 src="{{ URL::asset($course->image) }}">
                                        </td>
                                        <th class="align-middle fit">
                                            <a href="{{ URL::asset("/course/$course->id") }}" class="text-danger">
                                                {{$course->name}}
                                            </a>
                                        </th>
                                        <td class="align-middle d-none d-sm-none d-md-table-cell">{{$course->description}}</td>
                                        <td class="align-middle fit">{{$course->group->name}}</td>
                                        <td class="align-middle fit">
                                            {{$course->time}}
                                            ساعت
                                        </td>
                                        <td class="align-middle fit">
                                            {{$course->price}}
                                            تومان
                                        </td>
                                        <td class="align-middle">
                                            <a href="#"
                                               class="btn-outline-primary btn btn-sm btn-block">
                                                <span class="fas fa-edit fa-fw"></span>
                                            </a>
                                        </td>
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