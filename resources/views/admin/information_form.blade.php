@extends('admin.template')

@section('title')
    {{ isset($information) ? 'ویرایش اطلاعات' : 'اطلاعات تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($information) ? 'ویرایش اطلاعات' : 'اطلاعات تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ URL::asset("/admin/information") }}/{{ isset($information) ? 'edit' : 'add' }}"
                          id="form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>نام (انگلیسی)</label>
                                        <input name="name" type="text" placeholder="Name" required readonly
                                               class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('name') ? Request::old('name') : (isset($information) ? $information->name : '') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>توصیف (فارسی)</label>
                                        <input type="text" name="description" placeholder="Description" autofocus
                                               class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('description') ? Request::old('description') : (isset($information) ? $information->description : '') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>محتوا</label>
                                    <textarea name="value" id="editor"
                                              class="form-control">{{Request::old('value') ? Request::old('value') : (isset($information) ? $information->value : '') }}</textarea>
                                </div>

                                <input name="id" type="hidden"
                                       value="{{ isset($information) ? $information->id : '' }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection