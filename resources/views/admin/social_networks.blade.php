@extends('admin.template')

@section('title')
    شبکه اجتماعی
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        شبکه اجتماعی
                    </h5>
                    <button type="button" class="btn btn-success float-left" data-toggle="modal"
                            data-target="#addModal">
                        <span class="fas fa-plus"></span>
                    </button>
                </div>
                <div class="card-body">
                    @if(count($social_networks) == 0)
                        <h5 class="card-title">شبکه اجتماعی وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <tbody>
                            @foreach($social_networks as $social_network)
                                <tr>
                                    <td><i class="{{ $social_network->icon }} fa-2x fa-fw"></i></td>
                                    <td>{{$social_network->description}}</td>
                                    <td>{{$social_network->name}}</td>
                                    <td>{{$social_network->link}}</td>
                                    <td align="left">

                                        <button type="button" data-toggle="modal"
                                                data-target="#editModal"
                                                data-name="{{$social_network->name}}"
                                                data-id="{{$social_network->id}}"
                                                data-description="{{$social_network->description}}"
                                                data-link="{{$social_network->link}}"
                                                data-icon="{{$social_network->icon}}"
                                                class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </button>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$social_network->id}}"
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">افزودن اطلاعات</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/social_network/add") }}" id="addForm">
                        <div class="form-group">
                            <label>نام فارسی</label>
                            <input type="text" name="description" placeholder="Description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>نام انگلیسی</label>
                            <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>لینک</label>
                            <input type="text" name="link" placeholder="Link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>نماد</label>
                            <input type="text" name="icon" placeholder="Font Awesome Icon" class="form-control">
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
                    <h5 class="modal-title">ویرایش اطلاعات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ URL::asset("/admin/social_network/edit") }}" id="editForm">
                        <div class="form-group">
                            <label>توضیح فارسی</label>
                            <input type="text" name="description" placeholder="Description" id="description" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>نام انگلیسی</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>لینک</label>
                            <input type="text" name="link" id="link" placeholder="Link" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>نماد</label>
                            <input type="text" name="icon" id="icon" placeholder="Font Awesome Icon" class="form-control">
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
            var link = button.data('link');
            var icon = button.data('icon');
            $(this).find('.modal-body #description').val(description);
            $(this).find('.modal-body #name').val(name);
            $(this).find('.modal-body #link').val(link);
            $(this).find('.modal-body #icon').val(icon);
            $(this).find('.modal-body #id').val(id);
        })

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/social_network/delete") }}' + '/' + id);
        })
    </script>
@endsection