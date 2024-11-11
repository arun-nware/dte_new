<!doctype html>
<html class="fixed has-top-menu has-left-sidebar-half" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template"/>
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? $siteSetting->app_name }}</title>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <link href="{{asset('app').'/'.$siteSetting->favicon}}" rel="icon">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">


    @include('layouts.pages.style')
    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: rgba(10,6,6,0.26)">
<!-- Preloader -->
<x-application-loader/>
<section class="body">


    @include('components.offline')
    @include('layouts.pages.header')
    @include('layouts.pages.sub-header')

    <div class="inner-wrapper">
        @include('layouts.pages.asidebar')

        <section role="main" class="content-body pb-0" >
            {{ $slot }}
            <x-footer />
        </section>
    </div>
</section>
<livewire:password-update-livewire-component />

</body>

@livewireScripts
@include('layouts.pages.script')

<script>
    // You can also initialize by yourself, like:
    $('.loading-overlay').loadingOverlay({
        "startShowing": false, // defaults to false
        "hideOnWindowLoad": true, // defaults to false
        "css": {} // object container css stuff, defaults to match backgroundColor and border-radius
    });

    //available options via data-overlay-options or passing object via javascript initialization
    // {
    // 	"startShowing": true | false, // defaults to false
    // 	"hideOnWindowLoad": true | false, // defaults to false
    // 	"css": {} // object container css stuff, defaults to match backgroundColor and border-radius
    // }

    $(document).ready(function () {
        $('.preloader').css('height', 0);
        setTimeout(function () {
            $('.preloader').children().hide();
        }, 200);
    })

    function onlyNumberKey(event, input) {
        return input.value = input.value.replace(/[^0-9]/g, '')
    }

    // if ($preloader) {
    //     $preloader.css('height', 0);
    //     setTimeout(function () {
    //         $preloader.children().hide();
    //     }, 200);
    // }

    jQuery(function () {

        $('.select2').each(function () {
            $(this).select2({
                theme: "bootstrap-5",
                dropdownParent: $(this).parent(), // fix select2 search input focus bug
            })
        })

        // fix select2 bootstrap modal scroll bug
        $(document).on('select2:close', '.select2', function (e) {
            var evt = "scroll.select2"
            $(e.target).parents().off(evt)
            $(window).off(evt)
        })

    })

</script>
</html>
