@extends('client.template')

@section('title')
   آیین نامه ها
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
       آیین نامه ها
    </h4>
    <div class="row">
        <div class="col-12">
            <div class="card bg-white border-0 shadow rounded-lg mb-5">
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        @foreach($regulations as $index => $regulation)
                            <div class="card">
                                <div class="card-header" id="heading{{ $index }}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapse{{ $index }}" aria-expanded="true"
                                                aria-controls="collapse{{ $index }}">
                                            {{$regulation->title}}
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{ $index }}" class="collapse"
                                     aria-labelledby="heading{{ $index }}"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $regulation->body !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection