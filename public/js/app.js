// Start Loading

$(document).ready(function () {

    $("#start").fadeOut(1000);

    $('.hover-danger').mouseenter(function () {
        $(this).addClass('shadow');
        $(this).addClass('bg-danger');
        $(this).addClass('text-white');
        $(this).find("i").removeClass('text-danger');
        $(this).find("b").removeClass('text-danger');
        $(this).find(".hover-image").addClass('white');
    });

    $('.hover-danger').mouseleave(function () {
        $(this).removeClass('shadow');
        $(this).removeClass('bg-danger');
        $(this).removeClass('text-white');
        $(this).find("i").addClass('text-danger');
        $(this).find("b").addClass('text-danger');
        $(this).find(".hover-image").removeClass('white');
    });

    $("#search-main-btn").click(function () {

        $(".main-menu-list").toggle();
        $("#search-main-input").toggle();
        $("#search-main-form").toggleClass('w-100');
    });

    var night_mode = false;
    $("#theme-switch").change(function () {
        if (night_mode == false) {
            $(".bg-light").toggleClass('bg-dark');
            $(".bg-light").toggleClass('bg-light');
            $(".text-light").toggleClass('text-dark');
            $(".text-light").toggleClass('text-light');
            $(".text-dark").toggleClass('text-light');
            $(".text-dark").toggleClass('text-dark');
            $(".navbar-light").toggleClass('navbar-dark');
            $(".navbar-light").toggleClass('navbar-light');

            night_mode = true;
        } else {
            $(".bg-dark").toggleClass('bg-light');
            $(".bg-dark").toggleClass('bg-dark');
            $(".text-dark").toggleClass('text-light');
            $(".text-dark").toggleClass('text-dark');
            $(".text-light").toggleClass('text-dark');
            $(".text-light").toggleClass('text-light');
            $(".navbar-dark").toggleClass('navbar-light');
            $(".navbar-dark").toggleClass('navbar-dark');

            night_mode = false;
        }
    });

    $("#myInput").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $('#nav-search-input').focus(function () {
        $('#nav-main-menu').toggle('slow');
        $('#nav-search-form').toggleClass('w-100');
    });

    $('#nav-search-input').blur(function () {
        $('#nav-search-form').toggleClass('w-100', 'slow');
        $('#nav-main-menu').toggle('slow');
    });

    // Add slideDown animation to Bootstrap dropdown when expanding.
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });

    $('#date').MdPersianDateTimePicker({
        targetTextSelector: '#inputDate',
        groupId: 'rangeSelector1',
        englishNumber: true
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    //admin

    $('#aside-menu > a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show');
    });

    // Go Top Button

    $(this).scroll(function () {
        if ($(this).scrollTop() < 100) {
            $('#goTop').fadeOut(500);
        } else {
            $('#goTop').fadeIn(500);
        }
    });

    $('#goTop').click(function () {
        $('html, body').animate({scrollTop: 0}, "slow");
    });
});