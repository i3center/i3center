@extends('client.template')

@section('title')
    وبلاگ
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <h2 class="font-weight-bold text-center my-1">
                بلاگ
            </h2>
            <p class="text-center text-danger my-3">
                 اخبار مجتمع بین الملل را در اینجا بخوانید
            </p>
            <div class="row">
                @foreach($topics as $topic)
                    <div class="col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <a href="{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}"
                           class="text-dark text-decoration-none">
                            <div class="card shadow-sm border-0 rounded text-justify h-100 bg-white hover-danger">
                                <img src="{{ URL::asset("$topic->image") }}" class="card-img-top"
                                     alt="{{$topic->title}}">
                                <div class="card-body px-3 pt-3 pb-0">
                                    <p>
                                        <small>
                                            {{$topic->created_date}}
                                        </small>
                                    </p>
                                    <h6 class="card-title text-justify">
                                        {{$topic->title}}
                                    </h6>
                                    <p class="card-text text-justify">
                                        <small>
                                            {{ $topic->body }}
                                        </small>
                                    </p>
                                </div>
                                <div class="card-footer border-0 bg-transparent px-3 pb-3 pt-0">
                                    <i class="fas fa-arrow-left fa-pull-left text-danger"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <br>
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <nav aria-label="Page navigation example">
                            {{ $topics->links("pagination::bootstrap-4") }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection