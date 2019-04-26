@extends('admin.template')

@section('title')
    کلاس های آموزشی
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2 mb-5 small">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        کلاس های آموزشی
                    </h5>
                    <a href="{{ URL::asset("/admin/i3class/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($i3classes) == 0)
                        <h5 class="card-title">کلاسی وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border align-middle">
                            <thead>
                            <tr>
                                <th scope="col" width="5%"></th>
                                <th scope="col">دوره</th>
                                <th scope="col">استاد</th>
                                <th scope="col">تاریخ شروع</th>
                                <th scope="col">ساعت</th>
                                <th scope="col">روز</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($i3classes as $i3class)
                                <tr>
                                    <td>
                                        <img class="img-fluid rounded"
                                             src="{{ URL::asset("/public/image/course/$i3class->image") }}">
                                    </td>
                                    <th class="align-middle fit">{{$i3class->name}}</th>
                                    <td class="align-middle">{{$i3class->teacher_name}}</td>
                                    <td class="align-middle">{{$i3class->start_date}}</td>
                                    <td class="align-middle">{{$i3class->start_time}} - {{$i3class->end_time}}</td>
                                    <td class="align-middle">{{$i3class->weekdays}}</td>

                                    <td class="align-middle fit">
                                        <a href="{{ URL::asset("/course/$i3class->id") }}"
                                           class="btn-outline-primary btn btn-sm">
                                            <span class=" fas fa-eye fa-fw"></span>
                                        </a>
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
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <nav aria-label="Page navigation example">
                                        {{ $i3classes->links("pagination::bootstrap-4") }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
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