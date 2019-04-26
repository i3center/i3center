@extends('admin.template')

@section('title')
    کلاس های آموزشی
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2 mb-5">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        کلاس های آموزشی
                    </h5>
                    <a href="{{ URL::asset("/admin/i3class/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
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
                                <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        @if(count($i3classes["value"]) == 0)
                                            <h5 class="card-title">کلاسی وجود ندارد</h5>
                                        @else
                                            <table class="table table-striped table-hover border align-middle small">
                                                <thead>
                                                <tr>
                                                    <th scope="col" width="50px"></th>
                                                    <th scope="col">دوره</th>
                                                    <th scope="col">استاد</th>
                                                    <th scope="col">تاریخ شروع</th>
                                                    <th scope="col">ساعت</th>
                                                    <th scope="col">روز</th>
                                                    <th scope="col">ظرفیت</th>
                                                    <th scope="col">وضعیت</th>
                                                    <th scope="col"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="myTable">
                                                @foreach($i3classes["value"] as $i3class)
                                                    <tr>
                                                        <td class="align-middle">
                                                            <img class="img-fluid rounded"
                                                                 src="{{ URL::asset($i3class->course->image) }}">
                                                        </td>
                                                        <th class="align-middle">
                                                            <a href="{{ URL::asset("/i3class/$i3class->id") }}"
                                                               class="text-danger">
                                                                {{$i3class->course->name}}
                                                            </a>
                                                        </th>
                                                        <td class="align-middle fit">{{$i3class->teacher->name}}</td>
                                                        <td class="align-middle">{{$i3class->start_date}}</td>
                                                        <td class="align-middle">{{$i3class->start_time}}
                                                            - {{$i3class->end_time}}</td>
                                                        <td class="align-middle">{{$i3class->weekdays}}</td>
                                                        <td class="align-middle">{{$i3class->capacity}}</td>
                                                        <td class="align-middle fit">
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{ URL::asset("/admin/i3class/change_state/1/$i3class->id") }}"
                                                                   class="btn btn-outline-success btn-sm {{ $i3class->state == '1' ? 'active' : '' }}">
                                                                    ثبت&zwnj;نام
                                                                </a>
                                                                <a href="{{ URL::asset("/admin/i3class/change_state/2/$i3class->id") }}"
                                                                   class="btn btn-outline-success btn-sm {{ $i3class->state == '2' ? 'active' : '' }}">
                                                                    برگزاری
                                                                </a>
                                                                <a href="{{ URL::asset("/admin/i3class/change_state/3/$i3class->id") }}"
                                                                   class="btn btn-outline-success btn-sm {{ $i3class->state == '3' ? 'active' : '' }}">
                                                                    قدیمی
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td class="align-middle fit">
                                                            <a href="{{ URL::asset("/admin/i3class/edit/$i3class->id") }}"
                                                               class="btn-outline-info btn btn-sm">
                                                                <span class="fas fa-pen fa-fw"></span>
                                                            </a>

                                                            <button type="button" data-toggle="modal"
                                                                    data-target="#deleteModal"
                                                                    data-id="{{$i3class->id}}"
                                                                    class="btn-outline-danger btn btn-sm">
                                                                <span class="fas fa-times fa-fw"></span>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-muted">
                    برای افزودن کلاس آموزشی جدید <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <script>

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/i3class/delete") }}' + '/' + id);
        })
    </script>
@endsection