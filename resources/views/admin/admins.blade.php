@extends('admin.template')

@section('title')
    اساتید
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        اساتید
                    </h5>
                    <a href="/admin/admin/add" class="btn btn-success btn-sm float-left pb-0">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if(count($admins) == 0)
                        <h5 class="card-title">دوره ای وجود ندارد</h5>
                    @else
                        <table class="table table-striped border">
                            <thead>
                            <tr>
                                <th scope="col" width="100px"></th>
                                <th scope="col">نام</th>
                                <th scope="col">کد ملی</th>
                                <th scope="col">تاریخ تولد</th>
                                <th scope="col">مدرک</th>
                                <th scope="col">شماره همراه</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">تلگرام</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>
                                        <img class="img-fluid rounded-circle" src="/public/image/admin/{{$admin->image}}">
                                    </td>
                                    <th scope="row">{{$admin->name}}</th>
                                    <th>{{$admin->national_code}}</th>
                                    <td>{{$admin->birth_date}}</td>
                                    <td>{{$admin->degree_id}}</td>
                                    <td>{{$admin->phone_number}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->telegram}}</td>
                                    <td align="left">
                                        <a href="/admin/admin/{{$admin->id}}"
                                           class="btn-outline-primary btn btn-sm pb-0">
                                            <i class=" fas fa-eye"></i>
                                        </a>
                                        <a href="/admin/admin/edit/{{$admin->id}}"
                                           class="btn-outline-info btn btn-sm pb-0">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <a href="/admin/admin/delete/{{$admin->id}}"
                                           class="btn-outline-danger btn btn-sm pb-0">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="card-footer text-muted">
                    برای افزودن استاد جدید <i class="fas fa-plus-circle"></i> را بزنید
                </div>
            </div>
@endsection