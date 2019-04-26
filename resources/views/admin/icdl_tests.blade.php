@extends('admin.template')

@section('title')
    آزمون های ICDL
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow rounded-lg border-0 pt-2 mb-5 small">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title d-inline text-danger">
                        آزمون های ICDL
                    </h5>
                    <button type="submit" class="btn btn-success float-left" form="form">ذخیره</button>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ URL::asset("/admin/icdl/test/edit") }}" id="form">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>شماره آزمون</label>
                                <input type="number" class="form-control" name="icdl_test_number"
                                       placeholder="Test number"
                                       value="{{Request::old('icdl_test_number') ? Request::old('icdl_test_number') : (isset($icdl_test_number) ? strip_tags($icdl_test_number->value) : '') }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label>تاریخ آزمون</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                            <span class="input-group-text cursor-pointer" id="date">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                    </div>
                                    <input type="text" id="inputDate" name="icdl_test_date" required
                                           class="form-control {{$errors->has('icdl_test_date') ? 'is-invalid' : ''}}"
                                           aria-label="date" aria-describedby="date"
                                           value="{{Request::old('icdl_test_date') ? Request::old('icdl_test_date') : (isset($icdl_test_date) ? strip_tags($icdl_test_date->value) : '') }}">
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col" class="fit">#</th>
                                @foreach($icdl_test_times as $time)
                                    <th scope="col">{{ $time }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 1; $i <= 10; $i++)
                                <tr>
                                    <th scope="row">{{ $i }}</th>
                                    @foreach($icdl_test_times as $t => $time)
                                        <td>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm"
                                                       name="student_name[{{ $i }}][{{ $t }}]" placeholder="نام دانشجو"
                                                       value="{{Request::old("student_name[$i][$t]") ? Request::old("student_name[$i][$t]") : (isset($icdl_tests["student_name"][$i][$t])  ? $icdl_tests["student_name"][$i][$t] : '') }}">
                                            </div>
                                            <div class="form-group mb-0">
                                                <select class="form-control form-control-sm"
                                                        name="course_id[{{ $i }}][{{ $t }}]">
                                                    @foreach($courses as $course)
                                                        <option value="{{$course->id}}" {{Request::old("course_id[$i][$t]") && Request::old("course_id[$i][$t]") == $course->id ? 'selected' : (isset($icdl_tests["course_id"][$i][$t]) && $icdl_tests["course_id"][$i][$t] == $course->id ? 'selected' : '') }}>
                                                            {{$course->name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            @endfor
                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection