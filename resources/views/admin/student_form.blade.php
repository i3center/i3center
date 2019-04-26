@extends('admin.template')

@section('title')
    {{ isset($student) ? 'ویرایش دانشجو' : 'دانشجوی تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($student) ? 'ویرایش دانشجو' : 'دانشجوی تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="{{ URL::asset("/admin/student") }}/{{ isset($student) ? 'edit' : 'add' }}"
                          enctype="multipart/form-data" id="form">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>نام</label>
                                        <input name="name" type="text" placeholder="Name" required autofocus
                                               class="form-control rounded-lg {{$errors->has('name') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('name') ? Request::old('name') : (isset($student) ? $student->name : '') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>نام خانوادگی</label>
                                        <input name="family" type="text" placeholder="Family" required
                                               class="form-control rounded-lg {{$errors->has('family') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('family') ? Request::old('family') : (isset($student) ? $student->family : '') }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>نام پدر</label>
                                        <input name="father_name" type="text" placeholder="Father Name" required
                                               class="form-control rounded-lg {{$errors->has('father_name') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('father_name') ? Request::old('father_name') : (isset($student) ? $student->father_name : '')}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>شماره ملی</label>
                                        <input name="national_code" type="text" placeholder="National Code" required
                                               class="form-control rounded-lg {{$errors->has('national_code') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('national_code') ? Request::old('national_code') : (isset($student) ? $student->national_code : '') }}">
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
                                                   value="{{Request::old('birth_date') ? Request::old('birth_date') : (isset($student) ? $student->birth_date : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>ایمیل</label>
                                        <input name="email" type="email" placeholder="Email" required
                                               class="form-control rounded-lg {{$errors->has('email') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('email') ? Request::old('email') : (isset($student) ? $student->email : '') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>شماره همراه</label>
                                        <input name="phone_number" type="text" placeholder="Phone Number" required
                                               class="form-control rounded-lg {{$errors->has('phone_number') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('phone_number') ? Request::old('phone_number') : (isset($student) ? $student->phone_number : '') }}">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>شماره منزل</label>
                                        <input name="home_number" type="text" placeholder="Home Number" required
                                               class="form-control rounded-lg {{$errors->has('home_number') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('home_number') ? Request::old('home_number') : (isset($student) ? $student->home_number : '') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>آدرس</label>
                                    <input name="address" type="text" placeholder="Address" required
                                           class="form-control rounded-lg {{$errors->has('address') ? 'is-invalid' : ''}}"
                                           value="{{Request::old('address') ? Request::old('address') : (isset($student) ? $student->address : '') }}">
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>نام کاربری</label>
                                        <input name="username" type="text" placeholder="Username" required
                                               class="form-control rounded-lg {{$errors->has('username') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('username') ? Request::old('username') : (isset($student) ? $student->username : '') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>کلمه عبور</label>
                                        <input name="password" type="text" placeholder="Password" required
                                               class="form-control rounded-lg {{$errors->has('password') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('password') ? Request::old('password') : (isset($student) ? $student->password : '') }}">
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
                                        <input id="thumbnail" class="form-control" type="text" name="image"
                                               value="{{Request::old('image') ? Request::old('image') : (isset($student) ? $student->image : '') }}">
                                    </div>
                                </div>
                                <img id="img-preview" class="img-fluid rounded-lg"
                                     src="{{ isset($student) ? URL::asset("$student->image") : '' }}">
                            </div>
                        </div>
                        <input name="id" type="hidden" value="{{ isset($student) ? $student->id : '' }}">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection