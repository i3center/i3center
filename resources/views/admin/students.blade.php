@extends('admin.template')

@section('title')
    دانشجویان
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2 small">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        دانشجویان
                    </h5>
                    <a href="{{ URL::asset("/admin/student/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($students) == 0)
                        <h5 class="card-title">دانشجویی وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <thead>
                            <tr>
                                <th scope="col" width="100px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">نام خانوادگی</th>
                                <th scope="col">کد ملی</th>
                                <th scope="col">تاریخ تولد</th>
                                <th scope="col">نام کاربری</th>
                                <th scope="col">کلمه عبور</th>
                                <th scope="col">شماره همراه</th>
                                <th scope="col">شماره منزل</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($students as $student)
                                <tr>
                                    <td>
                                        <img class="img-fluid rounded-circle" src="{{ URL::asset("/public/image/student/$student->image") }}">
                                    </td>
                                    <th class="align-middle">{{$student->name}}</th>
                                    <td class="align-middle">{{$student->family}}</td>
                                    <td class="align-middle">{{$student->national_code}}</td>
                                    <td class="align-middle">{{$student->birth_date}}</td>
                                    <td class="align-middle">{{$student->username}}</td>
                                    <td class="align-middle">{{$student->password}}</td>
                                    <td class="align-middle">{{$student->phone_number}}</td>
                                    <td class="align-middle">{{$student->home_number}}</td>
                                    <td class="align-middle fit">
                                        <a href="{{ URL::asset("/admin/student/$student->id") }}"
                                           class="btn-outline-primary btn btn-sm">
                                            <span class=" fas fa-eye fa-fw"></span>
                                        </a>
                                        <a href="{{ URL::asset("/admin/student/edit/$student->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$student->id}}"
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
                    برای افزودن دانشجوی جدید <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/student/delete") }}' + '/' + id);
        })
    </script>
@endsection