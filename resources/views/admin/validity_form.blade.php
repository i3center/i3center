@extends('admin.template')

@section('title')
    {{ isset($validity) ? 'ویرایش اعتبار' : 'اعتبار تازه' }}
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($validity) ? 'ویرایش اعتبار' : 'اعتبار تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form method="post"
                                  action="{{ URL::asset("/admin/validity") }}/{{ isset($validity) ? 'edit' : 'add' }}"
                                  enctype="multipart/form-data" id="form">

                                <div class="form-group">
                                    <label>توضیح</label>
                                    <textarea name="caption"
                                              id="editor">{{Request::old('caption') ? Request::old('caption') : (isset($validity) ? $validity->caption : '') }}</textarea>
                                </div>

                                <label>تصویر</label>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <button type="button" class="btn btn-primary btn-block" id="lfm"
                                                data-input="thumbnail" data-preview="img-preview">
                                            بارگزاری تصویر
                                        </button>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input id="thumbnail" class="form-control" type="text" name="image" dir="ltr"
                                               value="{{Request::old('image') ? Request::old('image') : (isset($validity) ? $validity->image : '') }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <img id="img-preview" class="img-fluid rounded-lg"
                                             src="{{ isset($validity) ? URL::asset("$validity->image") : '' }}">
                                    </div>
                                </div>

                                <input name="id" type="hidden" value="{{ isset($validity) ? $validity->id : '' }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



