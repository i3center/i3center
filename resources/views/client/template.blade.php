@extends('master')

@section('title')
    بین الملل
@endsection
@section('template')

    <!-- Start Loading -->
    @if(Request::is('/'))
        <div id="start">
            <div class="row align-items-center  justify-content-center h-100">
                <div class="col-md-3 align-self-center">
                    <div class="row justify-content-center">
                        <img src="{{URL::asset('/photos/1/logo.png')}}" class="img-fluid justify-self-center"
                             alt="i3center logo">
                        <div id="loading"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('client.header')
    <br>
    <div class="container-fluid mt-5">
        @if(Session::has('message'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-info" role="alert">
                        {{Session::get('message')}}
                    </div>
                </div>
            </div>
        @endif
        @if(count($errors) > 0)
            <div class="row">
                <div class="col-md-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    <!-- breadcrumb -->

        @if(!Request::is('/'))
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb small">
                    <li class="breadcrumb-item">
                        <a href="{{URL::asset('/')}}" class="text-danger text-decoration-none">بین الملل</a>
                    </li>
                    <?php $segments = ''; ?>
                    @foreach(Request::segments() as $segment)
                        <?php $segments .= '/' . $segment; ?>
                        <li class="breadcrumb-item">
                            <a href="{{URL::asset($segments)  }}" class="text-danger text-decoration-none">
                                {{array_key_exists($segment, $dictionary) ? $dictionary[$segment] : $segment }}
                            </a>
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif

        @yield('content')
    </div>
    @include('client.footer')

    <a href="#" class="btn btn-danger btn-sm rounded-lg shadow" id="goTop">
        <span class="fas fa-arrow-up"></span>
    </a>
@endsection
