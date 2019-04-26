@extends('client.template')

@section('title')
    بین الملل
@endsection

@section('description'){{ $description }}@endsection

@section('keywords'){{ $keywords }}@endsection

@section('content')

    <div class="row">
        <div class="col-12 mb-4">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach($sliders as $index => $slider)
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{$index}}"
                            class="{{$index == 0 ? 'active':''}}"></li>
                    @endforeach
                </ol>
                <div class="carousel-inner shadow-sm rounded">
                    @foreach($sliders as $index => $slider)
                        <div class="carousel-item {{$index == 0 ? 'active':''}}">
                            <a href="{{ URL::asset($slider->url) }}">
                                <img src="{{ URL::asset($slider->image) }}" class="d-block w-100"
                                     alt="{{ $slider->title }}">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $slider->title }}</h5>
                                    {!! $slider->caption !!}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-2">
            <h5 class="text-dark">
                کلاس های آموزشی
            </h5>
            <a href="{{ URL::asset("/contact") }}" class="btn btn-light btn-sm text-danger">
                <i class="fas fa-arrow-left fa-fw"></i>
                مشاوره رایگان
                <i class="fas fa-arrow-right fa-fw"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($i3classes as $i3class)
            <div class="col-lg-3 col-sm-6 col-12 mb-4">
                @include('client.course_card')
            </div>
        @endforeach
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <a href="{{ URL::asset("/i3class") }}" class="text-danger text-decoration-none">
                <div class="card shadow-sm rounded text-center px-3 pt-3 pb-0 h-100 card-all-class hover-danger">
                    <img src="/photos/1/i3logo.png"
                         class="img-fluid mx-auto w-50 hover-image" alt="">
                    <div class="card-body p-0">
                        <h6 class="card-title mt-3">همه دوره های بین الملل </h6>
                        <p class="card-text text-wrap small border-danger">
                            جهانی بیاموزیم
                            <br>
                            جهانی بیاندیشیم
                        </p>
                    </div>
                    <div class="card-footer border-0 bg-transparent p-0 m-0">
                        <img src="/photos/1/card-all-class.png" class="img-fluid" style=" bottom: 0">
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm rounded">
                <a href="{{ URL::asset($images[0]->url) }}" class="text-white">
                    <img src="{{ URL::asset($images[0]->image) }}" class="card-img rounded" alt="{{$images[0]->title}}">
                    <div class="card-img-overlay d-none d-sm-none d-md-block d-lg-block d-xl-block">
                        <h4 class="card-title">{{ $images[0]->title }}</h4>
                        <div class="card-text">{!! $images[0]->caption !!}</div>
                    </div>
                </a>
            </div>
            <div class="card shadow-sm rounded d-block d-sm-block d-md-none d-lg-none d-xl-none mt-1">
                <div class="card-body">
                    <h6 class="card-title text-justify">{{ $images[0]->title }}</h6>
                    <div class="card-text text-justify">{!! $images[0]->caption !!}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-2">
            <h5>
                تازه چه خبر؟!
            </h5>

            <a href="{{ URL::asset("/blog") }}" class="btn btn-light text-danger">
                <i class="fas fa-arrow-left fa-fw"></i>
                خبرهای بین الملل رو در بلاگ دنبال کن
                <i class="fas fa-arrow-right fa-fw"></i>
            </a>
        </div>
    </div>
    <div class="row">
        @foreach($topics as $topic)
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <a href="{{ URL::asset("/blog/" . $topic->category->name . "/" . $topic->id) }}"
                   class="text-dark text-decoration-none">
                    <div class="card shadow-sm border-0 rounded text-justify h-100 bg-white hover-danger">
                        <img src="{{ URL::asset($topic->image) }}" class="card-img-top" alt="{{ $topic->title }}">
                        <div class="card-body px-3 pt-3 pb-0">
                            <p class="small">
                                {{ $topic->created_date }}
                            </p>
                            <h6 class="card-title text-justify">
                                {{ $topic->title }}
                            </h6>
                            <p class="card-text text-justify small">
                                {{ $topic->body }}
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
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm rounded">
                <a href="{{ URL::asset($images[1]->url) }}" class="text-white">
                    <img src="{{ URL::asset($images[1]->image) }}" class="card-img rounded" alt="{{$images[1]->title}}">
                    <div class="card-img-overlay d-none d-sm-none d-md-block d-lg-block d-xl-block">
                        <h4 class="card-title text-dark">{{ $images[1]->title }}</h4>
                        <div class="card-text text-dark">{!! $images[1]->caption !!}</div>
                    </div>
                </a>
            </div>
            <div class="card shadow-sm rounded d-block d-sm-block d-md-none d-lg-none d-xl-none mt-1">
                <div class="card-body">
                    <h6 class="card-title text-justify">{{ $images[1]->title }}</h6>
                    <div class="card-text text-justify">{!! $images[1]->caption !!}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($logos as $logo)
            <div class="col-md-1 col-sm-2 col-2 mb-4">
                <a href="{{ $logo->link }}">
                    <img src="{{ URL::asset($logo->image) }}" class="img-fluid img-index-end" alt="{{ $logo->name }}"
                         data-toggle="tooltip" data-placement="bottom" title="{{ $logo->name }}">
                </a>
            </div>
        @endforeach
    </div>

@endsection