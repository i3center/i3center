@extends('admin.template')

@section('title')
    کارمندان
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        کارمندان
                    </h5>
                    <a href="{{ URL::asset("/admin/employee/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($employees) == 0)
                        <h5 class="card-title">دوره ای وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <thead>
                            <tr>
                                <th scope="col" width="10%"></th>
                                <th scope="col">نام</th>
                                <th scope="col">کد ملی</th>
                                <th scope="col">تاریخ تولد</th>
                                <th scope="col">توضیح</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($employees as $employee)
                                <tr>
                                    <td>
                                        <img class="img-fluid rounded-circle" src="{{ URL::asset("$employee->image") }}">
                                    </td>
                                    <th class="align-middle" scope="row">{{$employee->name}}</th>
                                    <th class="align-middle">{{$employee->national_code}}</th>
                                    <td class="align-middle">{{$employee->birth_date}}</td>
                                    <td class="align-middle">{!! $employee->explanation !!}</td>
                                    <td class="align-middle">{{$employee->email}}</td>
                                    <td class="align-middle fit">
                                        <a href="{{ URL::asset("/admin/employee/edit/$employee->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$employee->id}}"
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
                <div class="card-footer text-muted">
                    برای افزودن استاد جدید <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <script>

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/employee/delete") }}' + '/' + id);
        })
    </script>

@endsection