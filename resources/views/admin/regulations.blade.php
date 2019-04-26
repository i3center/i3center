@extends('admin.template')

@section('title')
    آیین نامه
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        آیین نامه
                    </h5>
                    <a href="{{ URL::asset("/admin/regulation/add") }}" class="btn btn-success float-left">
                        <span class="fas fa-plus"></span>
                    </a>
                </div>
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($regulations) == 0)
                        <h5 class="card-title">آیین نامه وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <tbody>
                            @foreach($regulations as $regulation)
                                <tr>
                                    <td class="fit">{{$regulation->title}}</td>
                                    <td>{!! $regulation->body !!}</td>
                                    <td class="fit">
                                        <a href="{{ URL::asset("/admin/regulation/edit/$regulation->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$regulation->id}}"
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
                    برای افزودن آیین نامه تازه <i class="fas fa-plus-square"></i> را بزنید
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/regulation/delete") }}' + '/' + id);
        })
    </script>
@endsection