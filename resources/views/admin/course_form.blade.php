@extends('admin.template')

@section('title')
    {{ isset($course) ? 'ویرایش دوره تخصصی' : 'دوره تخصصی تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($course) ? 'ویرایش دوره تخصصی' : 'دوره تخصصی تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/course") }}/{{isset($course) ? 'edit' : 'add'}}"
                          enctype="multipart/form-data" id="form">
                        <div class="row">
                            <div class="col-8">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">نام</label>
                                        <input name="name" id="name" type="text" required autofocus
                                               class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('name') ? Request::old('name') : (isset($course) ? $course->name : '') }}">

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="d-block">دسته</label>
                                        <div class="btn-group btn-group-toggle special" data-toggle="buttons">
                                            <label class="btn btn-info {{isset($course) && $course->special == 0 ? 'active' : ''}}">
                                                <input type="radio" name="special" value="0" id="option1"
                                                       autocomplete="off" {{isset($course) && $course->special == 0 ? 'checked' : ''}}>
                                                Normal
                                            </label>
                                            <label class="btn btn-info {{isset($course) && $course->special == 1 ? 'active' : ''}}">
                                                <input type="radio" name="special" value="1" id="option2"
                                                       autocomplete="off" {{isset($course) && $course->special == 1 ? 'checked' : ''}}>
                                                i3 Pack
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="pb-2">توصیف</label>
                                    <textarea name="explanation" id="editor"
                                              class="form-control">{{Request::old('explanation') ? Request::old('explanation') : (isset($course) ? $course->explanation : '') }}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>گروه</label>
                                        <select class="form-control" name="group_id">
                                            @foreach($groups as $group)
                                                <option value="{{$group->id}}" {{Request::old('group_id') && Request::old('group_id') == $group->id ? 'selected' : (isset($course) && $course->group_id == $group->id ? 'selected' : '') }}>
                                                    {{$group->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>هزینه</label>
                                        <input name="price" type="number" placeholder="Price" min="0" step="1"
                                               required
                                               class="form-control {{$errors->has('price') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('price') ? Request::old('price') : (isset($course) ? $course->price : '') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>ساعت</label>
                                        <input type="number" name="time" step="5" required
                                               class="form-control {{$errors->has('time') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('time') ? Request::old('time') : (isset($course) ? $course->time : '100') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>توضیح</label>
                                    <input name="description" type="text" required
                                           class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('description') ? Request::old('description') : (isset($course) ? $course->description : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>کلمات کلیدی</label>
                                    <input name="keywords" type="text" required
                                           class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('keywords') ? Request::old('keywords') : (isset($course) ? $course->keywords : '') }}">
                                </div>
                            </div>
                            <div class="col-4">
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
                                               value="{{Request::old('image') ? Request::old('image') : (isset($course) ? $course->image : '') }}">
                                    </div>
                                </div>
                                <img id="img-preview" class="img-fluid rounded-lg"
                                     src="{{ isset($course) ? URL::asset("$course->image") : '' }}">
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($course) ? $course->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



