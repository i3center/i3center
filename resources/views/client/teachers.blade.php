@extends('client.template')

@section('title')
    استادها
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        استادها
    </h4>
    <div class="row mb-4">
        @foreach($teachers as $teacher)
            <div class="col-lg-2 col-md-3 col-sm-12 mb-4">
                <a href="{{ URL::asset("/teacher/$teacher->id") }}" class="text-dark text-decoration-none">
                    <div class="card shadow-sm border-0 rounded text-center p-0 h-100 bg-white hover-danger">
                        <div class="img-container">
                            <img src="{{ URL::asset($teacher->image) }}" class="card-img-top" alt="{{$teacher->name}}">
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title mb-0">{{ $teacher->name }}</h6>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection