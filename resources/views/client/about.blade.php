@extends('client.template')

@section('title')
    درباره ما
@endsection
@section('content')

    <div class="row mb-4">
        <div class="col-12">
            <div class="card rounded-lg testimonial-card">
                <div class="view-cascade">
                    <img class="img-fluid rounded-top card-img-top-course-bg"
                         src="{{ URL::asset("/photos/1/image/about.jpg") }}" alt="">
                </div>
                <div class="avatar mx-auto bg-light shadow">
                    <img src="{{URL::asset('/photos/1/logo.jpg')}}" class="rounded-circle" alt="">
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about"
                               role="tab" aria-controls="pills-about" aria-selected="true">درباره ما</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-validity-tab" data-toggle="pill" href="#pills-validity"
                               role="tab" aria-controls="pills-validity" aria-selected="false">اعتبارها و افتخارها</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-about" role="tabpanel"
                             aria-labelledby="pills-about-tab">
                            <div class="text-justify">{!! $about->value !!}</div>
                        </div>
                        <div class="tab-pane fade" id="pills-validity" role="tabpanel" aria-labelledby="pills-validity-tab">
                            <div class="row mb-4">
                                @if(count($validities) == 0)
                                    <h5 class="card-title">اعتباری وجود ندارد</h5>
                                @else
                                    @foreach($validities as $validity)
                                        <div class="col-md-3">
                                            <img data-toggle="modal"
                                                 data-target="#Modal"
                                                 data-caption="{{ $validity->caption }}"
                                                 data-image="{{ URL::asset("$validity->image") }}"
                                                 class="img-fluid rounded"
                                                 src="{{ URL::asset("$validity->image") }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <h4 class="font-weight-bold text-center my-1">تیم ما </h4>
            <p class="text-center text-danger my-3"> همکاران مجتمع انفورماتیک بین الملل</p>
            <div class="row">
                @foreach($employees as $employee)
                    <div class="col-lg-4 col-md-4 col-sm-12 mb-4">
                        <div class="card shadow-sm border-0 rounded text-center p-0 h-100 bg-white hover-danger">
                            <div class="img-container">
                                <img src="{{URL::asset("$employee->image")}}" class="card-img-top"
                                     alt="{{$employee->name}}">
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{$employee->name}}</h6>
                                {!! $employee->explanation !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="" id="image" class="img-fluid rounded">
                </div>
                <div class="modal-footer text-center" id="caption" dir="rtl">
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#Modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var image = button.data('image');
            var caption = button.data('caption');
            $(this).find('.modal-content #caption').html(caption);
            $(this).find('.modal-body #image').attr('src', image);
        })
    </script>

@endsection