@extends('client.template')

@section('title')
    تخفیف ها
@endsection

@section('content')

    <h4 class="text-danger text-center my-4">
        تخفیف ها
    </h4>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card bg-white border-0 shadow-sm rounded">
                <div class="card-body">
                    <input class="form-control" id="myInput" type="text" placeholder="جستجو...">
                    <br>
                    @if(count($offs) == 0)
                        <h5 class="card-title">تخفیف وجود ندارد</h5>
                    @else
                        <table class="table table-striped table-hover border">
                            <thead>
                            <tr>
                                <th scope="col">عنوان</th>
                                <th scope="col">میزان تسهیلات</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">
                            @foreach($offs as $off)
                                <tr>
                                    <td>{{$off->title}}</td>
                                    <td>%{{$off->value}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="alert alert-danger mb-0" role="alert">
                        <ul class="pr-4 text-justify">
                            <li class="my-2">
                                برای تخفیف اساتید دانشگاه و فرهنگیان گرامی ارائه اصل و کپی حکم کارگزینی از
                                سازمان مربوطه و شناسنامه الزامی است.
                            </li>
                            <li class="my-2">
                                برای تخفیف فارغ التحصیلان برتر دانشگاه‌ها ارائه اصل و کپی مدرک دانشگاهی با معدل
                                18 به بالا الزامی است.
                            </li>
                            <li class="my-2">
                                برای تخفیف دانشجویان و دانش آموزان ارائه گواهی اشتغال به تحصیل از واحد آموزش
                                دانشگاه یا مدرسه الزامی است.
                            </li>
                            <li class="my-2">
                                تخفیف اساتید و کمک مدرسین مجموعه شامل عزیزانی می شود که در زمان ثبت نام  در مجتمع
                                انفورماتیک بین الملل مشغول به کار باشند.
                            </li>
                            <li class="my-2">
                                تخفیف نقدی برای دوره هایی با هزینه سرمایه گزاری حداقل ۵۰۰ هزار تومان در نظر گرفته شده
                                است.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection