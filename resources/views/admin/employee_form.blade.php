@extends('admin.template')

@section('title')
    {{ isset($employee) ? 'ویرایش کارمند' : 'کارمند تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($employee) ? 'ویرایش کارمند' : 'کارمند تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ URL::asset("/admin/employee") }}/{{ isset($employee) ? 'edit' : 'add' }}"
                          enctype="multipart/form-data" id="form">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>نام</label>
                                        <input name="name" type="text" placeholder="Name" required autofocus
                                               class="form-control rounded-lg {{$errors->has('name') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('name') ? Request::old('name') : (isset($employee) ? $employee->name : '') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>کد ملی</label>
                                        <input name="national_code" type="text" placeholder="National Code" required
                                               class="form-control rounded-lg {{$errors->has('national_code') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('national_code') ? Request::old('national_code') : (isset($employee) ? $employee->national_code : '') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>تاریخ تولد</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text cursor-pointer" id="date">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            </div>
                                            <input type="text" id="inputDate" name="birth_date" required
                                                   class="form-control {{$errors->has('birth_date') ? 'is-invalid' : ''}}"
                                                   aria-label="date" aria-describedby="date"
                                                   value="{{Request::old('birth_date') ? Request::old('birth_date') : (isset($employee) ? $employee->birth_date : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>توضیح</label>
                                    <textarea name="explanation"
                                              id="editor">{{Request::old('explanation') ? Request::old('explanation') : (isset($employee) ? $employee->explanation : '') }}</textarea>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>ایمیل</label>
                                        <input name="email" type="email" placeholder="Email" required
                                               class="form-control rounded-lg {{$errors->has('email') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('email') ? Request::old('email') : (isset($employee) ? $employee->email : '') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>اینستاگرام</label>
                                        <input name="instagram" type="text" placeholder="Instagram" required
                                               class="form-control rounded-lg {{$errors->has('instagram') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('instagram') ? Request::old('instagram') : (isset($employee) ? $employee->instagram : '') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>تلگرام</label>
                                        <input name="telegram" type="text" placeholder="Telegram" required
                                               class="form-control rounded-lg {{$errors->has('telegram') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('telegram') ? Request::old('telegram') : (isset($employee) ? $employee->telegram : '') }}">
                                    </div>
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
                                               value="{{Request::old('image') ? Request::old('image') : (isset($employee) ? $employee->image : '') }}">
                                    </div>
                                </div>
                                <img id="img-preview" class="img-fluid rounded-lg"
                                     src="{{ isset($employee) ? URL::asset("$employee->image") : '' }}">
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($employee) ? $employee->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection