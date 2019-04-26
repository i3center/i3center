@extends('admin.template')

@section('title')
    تخفیف
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        تخفیف
                    </h5>
                    <button type="button" class="btn btn-success float-left" data-toggle="modal"
                            data-target="#addModal">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($offs) == 0)
                        <h5 class="card-title">تخفیف وجود ندارد</h5>
                    @else

                        <table class="table table-striped table-hover border" id="myTable">
                            <tbody>
                            @foreach($offs as $off)
                                <tr>
                                    <td>{{$off->title}}</td>
                                    <td>{{$off->value}}</td>
                                    <td align="left">

                                        <button type="button" data-toggle="modal"
                                                data-target="#editModal"
                                                data-id="{{$off->id}}"
                                                data-title="{{$off->title}}"
                                                data-value="{{$off->value}}"
                                                class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </button>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$off->id}}"
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
                    برای افزودن تخفیف تازه <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">افزودن تخفیف</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/off/add") }}" id="addForm">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" name="title" placeholder="Title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>مقدار</label>
                            <input type="number" name="value" placeholder="Value" class="form-control">
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">ویرایش تخفیف</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/off/edit") }}" id="editForm">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" name="title" placeholder="Title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>مقدار</label>
                            <input type="number" name="value" id="value" placeholder="Value" class="form-control">
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
            var title = button.data('title');
            var value = button.data('value');
            $(this).find('.modal-body #title').val(title);
            $(this).find('.modal-body #value').val(value);
            $(this).find('.modal-body #id').val(id);
        })

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/off/delete") }}' + '/' + id);
        })
    </script>
@endsection