@extends('admin.template')

@section('title')
    {{ isset($topic) ? 'ویرایش پست' : 'پست تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($topic) ? 'ویرایش پست' : 'پست تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" id="form"
                          action="{{ URL::asset("/admin/blog/topic") }}/{{ isset($topic) ? 'edit' : 'add'}}">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="title">عنوان</label>
                                    <input name="title" type="text" placeholder="Title" required autofocus
                                           class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}"
                                           value="{{ Request::old('title') ? Request::old('title') : (isset($topic) ? $topic->title : '') }}">
                                </div>
                                <div class="form-group">
                                    <label>متن</label>
                                    <textarea name="body" id="editor"
                                              class="form-control">{{Request::old('body') ? Request::old('body') : (isset($topic) ? $topic->body : '') }}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="author">نویسنده</label>
                                        <select class="form-control" name="employee_id">
                                            @foreach($employees as $employee)
                                                <option value="{{$employee->id}}" {{Request::old('employee_id') && Request::old('employee_id') == $employee->id ? 'selected' : (isset($topic) && $topic->employee_id == $employee->id ? 'selected' : '') }}>
                                                    {{$employee->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>دسته بندی</label>
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{Request::old('category_id') && Request::old('category_id') == $category->id ? 'selected' : (isset($topic) && $topic->category_id == $category->id ? 'selected' : '') }}>
                                                    {{$category->description}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">توصیف</label>
                                    <input name="description" type="text" required placeholder="Description"
                                           class="form-control {{$errors->has('description') ? 'is-invalid"' : ''}}"
                                           value="{{Request::old('description') ? Request::old('description') : (isset($topic) ? $topic->description : '') }}">
                                </div>
                                <div class="form-group">
                                    <label for="keywords">کلمات کلیدی</label>
                                    <input name="keywords" type="text" required placeholder="Keywords"
                                           class="form-control {{$errors->has('keywords') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('keywords') ? Request::old('keywords') : (isset($topic) ? $topic->keywords : '') }}">
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
                                               value="{{Request::old('image') ? Request::old('image') : (isset($topic) ? $topic->image : '') }}">
                                    </div>
                                </div>
                                <img id="img-preview" class="img-fluid rounded-lg"
                                     src="{{ isset($topic) ? URL::asset("$topic->image") : '' }}">
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($topic) ? $topic->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection