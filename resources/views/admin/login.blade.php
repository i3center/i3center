@extends('master')

@section('title')
    بین الملل
@endsection

@section('style')
    <style>
        body, html {
            height: 100%;
        }

        * {
            box-sizing: border-box;
        }

        .bg-image {
            width: 110%;
            height: 110%;
            background-color: #dc3545;
            margin-right: -5%;
            margin-top: -5%;
        }

        .bg-image img {
            filter: blur(5px);
        }

        #login {
            background-color: rgba(255, 255, 255, 0.7);
        }
    </style>
@endsection

@section('template')

    <script src="https://www.google.com/recaptcha/api.js?render=6LdIvJwUAAAAAEoUCGiiLOBqi2O5cydcxnRVv1tz"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdIvJwUAAAAAEoUCGiiLOBqi2O5cydcxnRVv1tz', {action: 'homepage'});
        });
    </script>

    <div class="bg-image position-fixed">
        <img src="{{URL::asset('/photos/1/login/wallpaper-4.jpg')}}" class="mx-auto position-relative d-block">
    </div>
    <div class="container h-100">
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
        <div class="row justify-content-center h-100 align-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg rounded-lg" id="login">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <img src="{{ URL::asset("/photos/1/logo-red.png") }}" class="img-fluid" alt="i3center logo">
                        </div>
                        <form method="post" action="{{ URL::asset("/admin/login") }}">

                            <label>ایمیل</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-at fa-fw"></i></div>
                                </div>
                                <input name="email" type="email" class="form-control" placeholder="Email" required>
                            </div>

                            <label>کلمه عبور</label>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-lock fa-fw"></i></div>
                                </div>
                                <input name="password" type="password" class="form-control" placeholder="Password"
                                       required>
                            </div>
                            <div class="custom-control custom-checkbox mb-2">
                                <input type="checkbox" class="custom-control-input"
                                       id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">
                                    مرا به خاطر بسپار
                                </label>

                            </div>
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-primary btn-block rounded-lg">ورود</button>
                        </form>

                        <a class="btn btn-link btn-block mt-5" href="#" role="button">کلمه عبور رو فراموش کردی؟</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection