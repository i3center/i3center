@extends('admin.template')

@section('title')
    {{$course->title}}
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{route('admin.blog.topic.edit.get',['topic_id'=>$course->id])}}" class="btn btn-info">ویرایش</a>
                    <a href="{{route('admin.blog.topic.delete.get',['topic_id'=>$course->id])}}" class="btn btn-danger">حذف</a>
                </div>
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$course->name}}</h5>
                    <p class="card-text">{{$course->price}}</p>
                </div>
            </div>
        </div>
    </div>

@endsection



