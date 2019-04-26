@extends('admin.template')

@section('title')
    اعتبار
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                    اعتبار
                    </h5>
                    <a href="{{ URL::asset("/admin/validity/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    @if(count($validities) == 0)
                        <h5 class="card-title">اعتباری وجود ندارد</h5>
                    @else
                        <table class="table table-striped border">
                            <thead>
                            <tr>
                                <th scope="col">تصویر</th>
                                <th scope="col">توضیح</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($validities as $validity)
                                <tr>
                                    <td class="w-25">
                                        <img class="img-fluid rounded" src="{{ URL::asset("$validity->image") }}">

                                    </td>
                                    <td>{!! $validity->caption !!}</td>
                                    <td align="left">
                                        <a href="{{ URL::asset("/admin/validity/edit/$validity->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$validity->id}}"
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
                    برای افزودن اعتبار جدید <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/validity/delete") }}' + '/' + id);
        })
    </script>
@endsection