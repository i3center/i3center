@extends('admin.template')

@section('title')
    نمایه ها
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        نمایه ها
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($images) == 0)
                        <h5 class="card-title">نمایه ای وجود ندارد</h5>
                    @else
                        <table class="table table-striped border">
                            <thead>
                            <tr>
                                <th scope="col">تصویر</th>
                                <th scope="col">عنوان</th>
                                <th scope="col">توضیح</th>
                                <th scope="col">لینک</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($images as $image)
                                <tr>
                                    <td class="w-25">
                                        <img class="img-fluid rounded" src="{{ URL::asset("$image->image") }}">
                                    </td>
                                    <td>{{$image->title}}</td>
                                    <td>{!! $image->caption !!}</td>
                                    <td>{{$image->url}}</td>
                                    <td class="fit">
                                        <a href="{{ URL::asset("/admin/image/edit/$image->id") }}"
                                           class="btn-outline-info btn btn-sm">
                                            <span class="fas fa-pen"></span>
                                        </a>
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
@endsection