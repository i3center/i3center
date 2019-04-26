@extends('master')

@section('title')
    بین الملل
@endsection

@section('template')

    @include('admin.header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 h-100 d-none d-md-none d-lg-block small">
                @include('admin.aside')
            </div>
            <div class="col-md-12 col-lg-10 h-100 pt-3">
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
                @yield('content')
            </div>
        </div>

        <script>
            $(document).ready(function () {
                var domain = "";
                $('#lfm').filemanager('image', {prefix: domain});
            });
        </script>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <p class="mb-0">آیا برای حذف اطمینان دارید؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">برگشت</button>
                        <a href="#"
                           class="btn-danger btn" id="btn-delete">
                            حذف
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @yield('scripts')
        @include('admin.footer')
    </div>

@endsection