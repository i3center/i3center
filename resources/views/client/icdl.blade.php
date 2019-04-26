@extends('client.template')

@section('title')
    آزمون ICDL
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        آزمون ICDL
    </h4>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">

                            <div class="alert alert-info" role="alert">
                                <i class="fas fa-globe fa-fw"></i>
                                <strong>
                                    {{ strip_tags($icdl_test_number) }}
                                </strong>
                                مین آزمون بنیاد جهانی ICDL
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="alert alert-info" role="alert">
                                <span class="fas fa-calendar" aria-hidden="true"></span>
                                تاریخ برگزاری:
                                <strong>
                                    {{ strip_tags($icdl_test_date) }}
                                </strong>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="alert alert-info" role="alert">
                                <span class="fas fa-map-marker-alt" aria-hidden="true"></span>
                                مکان: موسسه بین الملل
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger" role="alert">
                                <ul class="pr-4 text-justify">
                                    <li class="my-2">
                                        از عزیزان خواهشمندیم با توجه به
                                        <strong>
                                            ظرفیت محدود
                                        </strong>
                                        در اولین فرصت ثبت نام
                                        نمایند.
                                    </li>
                                    <li class="my-2">
                                        کلاس های آمادگی طبق برنامه فقط برای یک بار در این ماه برگزار می
                                        شوند
                                        و تکرار نخواهند داشت.
                                    </li>
                                    <li class="my-2">
                                        حضور در کلاس الزامی می باشد و در غیر این صورت نمی توانید در آزمون شرکت کنید.
                                    </li>
                                    <li class="my-2">
                                        حتما نیم ساعت قبل از شروع آزمون در مجتمع حضورداشته باشید.
                                    </li>
                                    <li class="my-2">
                                        قابل توجه است برای شرکت در آزمون حتما کارت مهارت و کارت ملی به همراه داشته
                                        باشید.
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-pills nav-justified mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                               role="tab" aria-controls="pills-home" aria-selected="true">
                                برنامه کلاسی آمادگی آزمون ICDL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                               role="tab" aria-controls="pills-profile" aria-selected="false">
                                برنامه زمان بندی آزمون ICDL
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab">

                            <div class="row">
                                <div class="col-12">
                                    @if(count($i3classes) == 0)
                                        <h5 class="card-title">کلاسی وجود ندارد</h5>
                                    @else
                                        <table class="table table-striped table-hover table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">مهارت</th>
                                                <th scope="col">استاد</th>
                                                <th scope="col">روز</th>
                                                <th scope="col">تاریخ</th>
                                                <th scope="col">ساعت</th>
                                                <th scope="col">کلاس</th>
                                            </tr>
                                            </thead>
                                            <tbody id="myTable">
                                            @foreach($i3classes as $i3class)
                                                <tr>
                                                    <td class="align-middle fit">
                                                        <img class="rounded" width="50px"
                                                             src="{{ URL::asset($i3class->image) }}">
                                                    </td>
                                                    <th class="align-middle fit">{{$i3class->name}}</th>
                                                    <td class="align-middle fit">{{$i3class->teacher_name}}</td>
                                                    <td class="align-middle fit">
                                                        {{$i3class->weekdays}}
                                                    </td>
                                                    <td class="align-middle fit">
                                                        {{$i3class->start_date}}
                                                    </td>
                                                    <td class="align-middle fit">
                                                        {{$i3class->start_time}}
                                                        -
                                                        {{$i3class->end_time}}
                                                    </td>
                                                    <td class="align-middle fit">
                                                        {{$i3class->classroom_name}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab">
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-striped table-hover table-bordered mb-0 small">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="fit">سیستم</th>
                                            @foreach($icdl_test_times as $time)
                                                <th scope="col" class="fit">{{ $time }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form method="post" action="{{ URL::asset("/admin/icdl/test/edit") }}"
                                              id="form">
                                            @for($i = 1; $i <= 10; $i++)
                                                <tr>
                                                    <th scope="row" class="fit">
                                                        {{ tr_num($i, 'fa') }}
                                                    </th>
                                                    @foreach($icdl_test_times as $t => $time)
                                                        <td>
                                                            @if(isset($icdl_tests["student_name"][$i][$t]))
                                                                <p>
                                                                    {{ $icdl_tests["student_name"][$i][$t] }}
                                                                </p>
                                                                <p class="mb-0">
                                                                    {{ $icdl_tests["course_name"][$i][$t] }}
                                                                </p>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endfor
                                            <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <a href="javascript:window.print()" class="btn btn-info float-left d-print-none">
                                <span class="fas fa-print" aria-hidden="true"></span>
                                چاپ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection