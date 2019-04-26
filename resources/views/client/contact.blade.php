@extends('client.template')

@section('title')
    مشاوره و تماس
@endsection

@section('content')

    <script src="https://www.google.com/recaptcha/api.js?render=6LdIvJwUAAAAAEoUCGiiLOBqi2O5cydcxnRVv1tz"></script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('6LdIvJwUAAAAAEoUCGiiLOBqi2O5cydcxnRVv1tz', {action: 'homepage'});
        });
    </script>

    <div class="row">
        <div class="col-12">
            <div class="card card-cascade wider reverse mb-5">
                <div class="view view-cascade overlay">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5406.0042238582255!2d59.55623060635987!3d36.326142980384496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3f6c921b02fbe659%3A0x21a7cd41e4c2048a!2zMzbCsDE5JzM0LjIiTiA1OcKwMzMnMjAuNyJF!5e0!3m2!1sen!2s!4v1551126794247"
                            width="100%" height="100%" frameborder="0" class="card-img-top" allowfullscreen></iframe>
                </div>
                <div class="card-body card-body-cascade">
                    <div class="row">
                        <div class="col-md-8 mb-sm-3 mb-3 mb-md-0">
                            <h4 class="text-center mb-3">
                                مشاوره و تماس
                            </h4>
                            <div class="alert alert-danger text-justify" role="alert">
                                {{ strip_tags($contact->value) }}
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-12 mb-md-0">
                                    <form method="post" action="{{ URL::asset("/contact/add") }}">
                                        <div class="form-row">
                                            <div class="col-md-6 form-group">
                                                <label for="name" class="">نام</label>
                                                <input name="sender" type="text" class="form-control"
                                                       placeholder="Name" required>
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="email" class="">شماره تماس یا ایمیل</label>
                                                <input name="email" type="text" class="form-control"
                                                       placeholder="Phone number or Email" required>
                                                <small class="form-text text-muted">
                                                    اطلاعات شما نزد ما محرمانه می ماند
                                                </small>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="subject" class="">موضوع</label>
                                            <input type="text" id="subject" name="subject" class="form-control"
                                                   placeholder="Subject" required>
                                        </div>
                                        <div class="form-group">
                                            <label>پیام</label>
                                            <textarea name="body" class="form-control" placeholder="Message" rows="4"
                                                      required></textarea>
                                        </div>
                                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-success">ارسال</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-white bg-danger">
                                <div class="card-body">
                                    <p class="text-center w-responsive mx-auto text-justify">
                                        <small>
                                            <i class="fas fa-map-marker-alt"></i>
                                            آدرس
                                        </small>
                                        <br>
                                        <strong>
                                            {{ strip_tags($address_full) }}
                                        </strong>
                                    </p>
                                    <hr>
                                    <p class="text-center w-responsive mx-auto text-justify">
                                        <small>
                                            <i class="fas fa-clock"></i>
                                            ساعت کاری
                                        </small>
                                        <br>
                                        <strong>
                                            {{ strip_tags($work_time) }}
                                        </strong>
                                    </p>
                                    <hr>
                                    <p class="text-center w-responsive mx-auto text-justify">
                                        <small>
                                            <i class="fas fa-phone"></i>
                                            تلفن تماس
                                        </small>
                                        <br>
                                        <a href="tel:{{ strip_tags($phone_number) }}"
                                           class="btn btn-outline-light">
                                            {{ strip_tags($phone_number) }}
                                        </a>
                                        <a href="tel:{{ strip_tags($phone_number2) }}"
                                           class="btn btn-outline-light">
                                            {{ strip_tags($phone_number2) }}
                                        </a>
                                    </p>
                                    <hr>
                                    <p class="text-center w-responsive mx-auto text-justify">
                                        <small>
                                            <i class="fab fa-telegram-plane"></i>
                                            تلگرام کارشناسان آموزش:
                                        </small>
                                        <br>
                                        <a dir="ltr" href="{{ strip_tags($telegram) }}"
                                           class="btn btn-outline-light">
                                            @i3center
                                        </a>
                                    </p>
                                    <hr>
                                    <p class="text-center w-responsive mx-auto text-justify">
                                        <small>
                                            <i class="fas fa-envelope"></i>
                                            ایمیل
                                        </small>
                                        <br>
                                        <a href="mailto:{{ strip_tags($email) }}" class="btn btn-outline-light">
                                            {{ strip_tags($email) }}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



