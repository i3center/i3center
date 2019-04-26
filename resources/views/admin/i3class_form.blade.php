@extends('admin.template')

@section('title')
    {{ isset($i3class) ? 'ویرایش کلاس آموزشی' : 'کلاس آموزشی تازه' }}
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        {{ isset($i3class) ? 'ویرایش کلاس آموزشی' : 'کلاس آموزشی تازه' }}
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/i3class") }}/{{ isset($i3class) ? 'edit' : 'add' }}" id="form">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>کد گروه</label>
                                        <input name="code" type="number" placeholder="Code" min="0" required autofocus
                                               class="form-control {{$errors->has('capacity') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('code') ? Request::old('code') : (isset($i3class) ? $i3class->code : '9000') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="name">دوره تخصصی</label>
                                        <select class="form-control" name="course_id">
                                            @foreach($courses as $course)
                                                <option value="{{$course->id}}" {{Request::old('course_id') && Request::old('course_id') == $course->id ? 'selected' : (isset($i3class) && $i3class->course_id == $course->id ? 'selected' : '')  }}>
                                                    {{$course->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>استاد</label>
                                        <select class="form-control" name="teacher_id">
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}" {{Request::old('teacher_id') && Request::old('teacher_id') == $teacher->id ? 'selected' : (isset($i3class) && $i3class->teacher_id == $teacher->id ? 'selected' : '') }}>
                                                    {{$teacher->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label>تاریخ شروع</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text cursor-pointer" id="date">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            </div>
                                            <input type="text" id="inputDate" name="start_date" required
                                                   class="form-control {{$errors->has('start_date') ? 'is-invalid' : ''}}"
                                                   aria-label="date" aria-describedby="date"
                                                   value="{{Request::old('start_date') ? Request::old('start_date') : (isset($i3class) ? $i3class->start_date : '') }}">
                                        </div>
                                    </div>
                                    <div class="form-group col">
                                        <label>ساعت شروع</label>
                                        <input type="time" name="start_time" required
                                               class="form-control {{$errors->has('start_time') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('start_time') ? Request::old('start_time') : (isset($i3class) ? $i3class->start_time : '') }}">
                                    </div>
                                    <div class="form-group col">
                                        <label>ساعت پایان</label>
                                        <input type="time" name="end_time" required
                                               class="form-control {{$errors->has('end_time') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('end_time') ? Request::old('end_time') : (isset($i3class) ? $i3class->end_time : '') }}">
                                    </div>
                                </div>

                                <label>روزهای برگزاری</label>
                                <div class="btn-group btn-group-toggle special" data-toggle="buttons">

                                    @foreach($weekdays as $weekday)
                                        <label class="btn btn-info {{isset($i3class) && in_array($weekday, $i3class->weekdays) ? 'active' : ''}}">
                                            <input type="checkbox" name="weekdays[]" value="{{$weekday}}"
                                                   autocomplete="off" {{isset($i3class) && in_array($weekday, $i3class->weekdays) ? 'checked' : ''}}>
                                            {{$weekday}}
                                        </label>
                                    @endforeach
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>ظرفیت</label>
                                        <input name="capacity" type="number" placeholder="Capacity" min="0" required
                                               class="form-control {{$errors->has('capacity') ? 'is-invalid' : ''}}"
                                               value="{{Request::old('capacity') ? Request::old('capacity') : (isset($i3class) ? $i3class->capacity : '8') }}">
                                    </div>
                                    <div class="form-group col-md-6">

                                        <label>محل برگزاری</label>
                                        <select class="form-control" name="classroom_id">
                                            <option value="" disabled>انتخاب</option>
                                            @foreach($classrooms as $classroom)
                                                <option value="{{$classroom->id}}" {{Request::old('classroom_id') && Request::old('classroom_id') == $classroom->id ? 'selected' : (isset($i3class) && $i3class->classroom_id == $classroom->id ? 'selected' : '') }}>
                                                    {{$classroom->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <input name="id" type="hidden" value="{{ isset($i3class) ? $i3class->id : '' }}">
                                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection