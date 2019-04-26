@extends('admin.template')

@section('title')
    وبلاگ من
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        پیام ها
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($messages) == 0)
                        <h5 class="card-title">پیامی وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">نام</th>
                                <th scope="col">ایمیل</th>
                                <th scope="col">موضوع</th>
                                <th scope="col">پیام</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $message)
                                <tr>
                                    <td class="fit">
                                        @if($message->new == 1)
                                            <span class="badge badge-danger">جدید</span>
                                        @endif
                                    </td>
                                    <td class="fit">{{$message->sender}}</td>
                                    <td>{{$message->email}}</td>
                                    <td>{{$message->subject}}</td>
                                    <td>{{$message->body}}</td>
                                    <td class="fit">

                                        <a href="mailto:{{$message->email}}" class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-reply fa-fw"></span>
                                        </a>
                                        <button type="button" data-toggle="modal"
                                                data-target="#deleteModal"
                                                data-id="{{$message->id}}"
                                                class="btn-outline-danger btn btn-sm">
                                            <span class="fas fa-times fa-fw"></span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-center">
                                    <nav aria-label="Page navigation example">
                                        {{ $messages->links("pagination::bootstrap-4") }}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var btn_delete = $(this).find('.modal-footer #btn-delete');
            btn_delete.attr("href", '{{ URL::asset("/admin/message/delete") }}' + '/' + id);
        })
    </script>
@endsection



