@extends('admin.template')

@section('title')
    تحصیلات
@endsection
@section('content')

    <div class="row">
        <div class="col-6">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        تحصیلات
                    </h5>
                    <button type="button" class="btn btn-success float-left" data-toggle="modal"
                            data-target="#addModal">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div class="card-body">
                    @if(count($degrees) == 0)
                        <h5 class="card-title">تحصیلات وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <tbody>
                            @foreach($degrees as $degree)
                                <tr>
                                    <td>{{$degree->name}}</td>
                                    <td align="left">

                                        <button type="button" data-toggle="modal"
                                                data-target="#editModal"
                                                data-name="{{$degree->name}}"
                                                data-id="{{$degree->id}}"
                                                class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </button>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$degree->id}}"
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
                    برای افزودن تحصیلات جدید <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">افزودن تحصیلات</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/degree/add") }}" id="addForm">
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="name" class="form-control" placeholder="Name">
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">برگشت</button>
                    <button type="submit" class="btn btn-success" form="addForm">افزودن</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">ویرایش تحصیلات</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/degree/edit") }}" id="editForm">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">نام </label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                        <input name="id" type="hidden" id="id">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">برگشت</button>
                    <button type="submit" class="btn btn-success" form="editForm">ذخیره</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            $(this).find('.modal-body #name').val(name);
            $(this).find('.modal-body #id').val(id);
        })

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/degree/delete") }}' + '/' + id);
        })
    </script>
@endsection