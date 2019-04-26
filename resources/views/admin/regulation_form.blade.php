@extends('admin.template')

@section('title')
    {{ isset($regulation) ? 'ویرایش آیین نامه' : 'آیین نامه تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($regulation) ? 'ویرایش آیین نامه' : 'آیین نامه تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ URL::asset("/admin/regulation") }}/{{ isset($regulation) ? 'edit' : 'add' }}"
                          id="form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>عنوان</label>
                                    <input type="text" name="title" placeholder="Description" autofocus
                                           class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('title') ? Request::old('title') : (isset($regulation) ? $regulation->title : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>متن</label>
                                    <textarea name="body" id="editor"
                                              class="form-control">{{Request::old('body') ? Request::old('body') : (isset($regulation) ? $regulation->body : '') }}</textarea>
                                </div>
                                <input name="id" type="hidden"
                                       value="{{ isset($regulation) ? $regulation->id : '' }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection