@extends('client.template')

@section('title'){{$topic->title}}@endsection

@section('description'){{$topic->description}}@endsection

@section('keywords'){{$topic->keywords}}@endsection

@section('content')

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-sm-4 mb-4 mb-md-0">
                            <img src="{{ URL::asset($topic->image) }}"
                                 class="img-fluid shadow-sm rounded mx-auto d-block" alt="{{$topic->title}}">
                        </div>
                        <div class="col-md-8">
                            <p class="text-muted">
                                {{$topic->created_date}}
                                <span class="mx-2">|</span>
                                دسته:
                                <a href="{{ URL::asset("/blog/" . $topic->category->name) }}"
                                   class="btn btn-link btn-sm text-danger">
                                    {{ $topic->category->description }}
                                </a>
                            </p>
                            <h4 class="text-justify mb-4">{{$topic->title}}</h4>
                            <div class="text-justify">
                                {!! $topic->body !!}
                            </div>
                            <div class="text-muted pt-1">
                                <p>
                                    {{$topic->employee->name}}
                                </p>
                                {!! $topic->employee->explanation !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection