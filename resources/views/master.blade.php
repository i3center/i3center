<!doctype html>
<html lang="fa">
<head>
    <title>@yield('title')</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="application-name" content="i3center">
    <meta name="author" content="Sajjad Aemmi, Hadiseh Firouzabadi">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">

    <meta property="og:title" content="بین الملل"/>
    <meta property="og:site_name" content="i3center"/>
    <meta property="og:description" content="{{ $description }}"/>
    <meta property="og:image" content="{{ URL::asset('/photos/1/i3.png') }}"/>

    <link rel="shortcut icon" type="image/png" href="{{ URL::asset('/photos/1/i3.png') }}"/>
    <link rel="icon" href="{{ URL::asset('/photos/1/favicon.ico') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ URL::asset('/photos/1/favicon.ico') }}'/>
    <link rel="icon" href="{{ URL::asset('/photos/1/favicon.ico') }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('/css/jquery.md.bootstrap.datetimepicker.style.css') }}"/>
    <link rel="stylesheet" href="{{ URL::asset('/css/app.css') }}">

    @yield('style')

    <script src="{{URL::asset('/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{URL::asset('/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('/js/bootstrap.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{URL::asset('/js/jquery.md.bootstrap.datetimepicker.js')}}"></script>
    <script src="{{URL::asset('/js/app.js')}}"></script>

    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
    </script>
    <script src="{{URL::asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>

</head>
<body class="bg-light">

@yield('template')

<script>
    CKEDITOR.config.contentsLangDirection = 'rtl';
    CKEDITOR.replace('editor', options);
</script>
</body>
</html>