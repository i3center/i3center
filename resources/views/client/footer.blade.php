<div class="bg-white text-dark shadow-top border-0 rounded-0 pb-0 small d-print-none">
    <div class="card-header bg-transparent border-0 pb-0">
        <p class="text-center text-danger">
            با ما همراه بشین
        </p>
        <ul class="list-inline mb-0 text-center">
            @foreach($social_networks as $social_network)
                <li class="list-inline-item">
                    <a class="text-danger" href="{{ $social_network->link }}" data-toggle="tooltip"
                       data-placement="bottom" title="{{ $social_network->description }}">
                        <i class="{{ $social_network->icon }} fa-2x fa-fw"></i>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-sm-4 mb-4 mb-md-4 mb-lg-0">
                <ul class="list-group shadow-sm h-100">
                    <li class="list-group-item list-group-item-action p-2 active">
                        موسسه انفورماتیک بین الملل
                    </li>
                    <li class="list-group-item list-group-item-action p-2">
                        <i class="fas fa-phone fa-fw"></i>
                        تلفن تماس:
                        {{ strip_tags($phone_number) }}
                        -
                        {{ strip_tags($phone_number2) }}
                    </li>
                    <li class="list-group-item list-group-item-action p-2">
                        <i class="fas fa-envelope fa-fw"></i>
                        ایمیل:
                        {{ strip_tags($email) }}
                    </li>
                    <li class="list-group-item list-group-item-action p-2">
                        <i class="fas fa-clock fa-fw"></i>
                        ساعت کاری:
                        {{ strip_tags($work_time) }}
                    </li>
                    <li class="list-group-item list-group-item-action p-2">
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        {{ strip_tags($address) }}
                    </li>
                </ul>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-sm-4 mb-4 mb-md-4 mb-lg-0">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5406.0042238582255!2d59.55623060635987!3d36.326142980384496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c921b02fbe659%3A0x21a7cd41e4c2048a!2zMzbCsDE5JzM0LjIiTiA1OcKwMzMnMjAuNyJF!5e0!3m2!1sen!2s!4v1551126794247"
                        width="100%" height="100%" frameborder="0" class="rounded shadow-sm" allowfullscreen></iframe>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-sm-4 mb-4 mb-md-4 mb-lg-0">
                <div class="list-group shadow-sm h-100">
                    <a href="/blog" class="list-group-item list-group-item-action p-2 active">
                        اخبار بین الملل
                    </a>
                    @foreach($footer_categories as $category)
                        <a href="{{ URL::asset("/blog/$category->name") }}"
                           class="list-group-item list-group-item-action p-2">
                            {{ $category->description }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-0">
                <div class="list-group shadow-sm h-100">
                    <a href="#" class="list-group-item list-group-item-action p-2 active">
                        پیوندها
                    </a>
                    <a href="{{ URL::asset("/regulation") }}" class="list-group-item list-group-item-action p-2">
                        آیین نامه ها
                    </a>
                    <a href="#" class="list-group-item list-group-item-action p-2">
                        پورتال اساتید
                    </a>
                    <a href="#" class="list-group-item list-group-item-action p-2">
                        پورتال دانشجویان
                    </a>
                    <a href="http://iwmgroup.ir" class="list-group-item list-group-item-action p-2">
                        وب مارکتینگ بین الملل
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-center">
        i3center 2002 - {{date("Y")}} &copy;
        <p dir="ltr" class="mb-0">Made with <i class="fab fa-laravel text-danger"></i> , <i class="fa fa-heart text-danger"></i>
            and lots of <i class="fa fa-coffee text-danger"></i></p>
    </div>
</div>