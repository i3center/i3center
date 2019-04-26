@extends('admin.template')

@section('title')
    دسته بندی ها
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow rounded-lg border-0 pt-2 mb-5">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger"> دسته بندی ها</h5>
                    <button data-toggle="modal" data-target="#addModal" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>

                <div class="card-body">
                    @if(count($categories) == 0)
                        <h5 class="card-title">دسته بندی وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->name}}</td>
                                    <td align="left">

                                        <button type="button" data-toggle="modal"
                                                data-target="#editModal"
                                                data-description="{{$category->description}}"
                                                data-name="{{$category->name}}"
                                                data-id="{{$category->id}}"
                                                class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </button>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$category->id}}"
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
                    برای افزودن دسته بندی جدید <i class="fas fa-plus-square"></i> را بزنید
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
                    <h6 class="modal-title">
                        دسته بندی تازه
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/blog/category/add") }}" id="addForm">
                        <div class="form-group">
                            <label>توضیح (فارسی)</label>
                            <input type="text" name="description" placeholder="Description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>نام (انگلیسی)</label>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">برگشت</button>
                    <button type="submit" class="btn btn-success" form="addForm">ذخیره</button>
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
                    <h6 class="modal-title">
                        ویرایش دسته بندی
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/blog/category/edit") }}" id="editForm">
                        <div class="form-group">
                            <label>توضیح (فارسی)</label>
                            <input type="text" name="description" placeholder="Description" class="form-control"
                                   id="description">
                        </div>
                        <div class="form-group">
                            <label>نام (انگلیسی)</label>
                            <input type="text" name="name" placeholder="Name" class="form-control" id="name">
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
            var description = button.data('description');
            var name = button.data('name');
            $(this).find('.modal-body #description').val(description);
            $(this).find('.modal-body #name').val(name);
            $(this).find('.modal-body #id').val(id);
        })

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');

            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/blog/category/delete") }}' + '/' + id);
        })
    </script>
@endsection