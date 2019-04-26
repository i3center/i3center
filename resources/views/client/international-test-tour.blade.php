@extends('client.template')

@section('title')
    تور آزمون های بین المللی
@endsection

@section('content')

    <div class="row mb-4">
        <div class="col-12">
            <div class="card rounded-lg testimonial-card">
                <div class="view-cascade">
                    <img class="img-fluid rounded-top card-img-top-course-bg"
                         src="{{ URL::asset("/photos/1/image/slider1.jpg") }}" alt="">
                </div>
                <div class="avatar mx-auto bg-light shadow">
                    <img src="{{URL::asset('/photos/1/logo.jpg')}}" class="rounded-circle" alt="">
                </div>
                <div class="card-body text-justify">
                    <h4 class="text-danger text-center my-4">
                        تور آزمون های بین المللی
                    </h4>
                    {!! $internationalـtestـtour->value !!}
                    <br>
                    <br>
                    <a href="{{ URL::asset("/download/tourazmoon97-98.pdf") }}" class="btn btn-danger" download>
                        دانلود فایل
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection