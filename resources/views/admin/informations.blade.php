@extends('admin.template')

@section('title')
    اطلاعات
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        اطلاعات
                    </h5>
                    <a href="{{ URL::asset("/admin/information/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($informations) == 0)
                        <h5 class="card-title">اطلاعات وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <tbody>
                            @foreach($informations as $information)
                                <tr>
                                    <td class="fit">{{$information->description}}</td>
                                    <td class="fit">{{$information->name}}</td>
                                    <td>{!! $information->value !!}</td>
                                    <td class="fit">
                                        <a href="{{ URL::asset("/admin/information/edit/$information->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="card-footer text-muted">
                    برای افزودن اطلاعات تازه <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

@endsection