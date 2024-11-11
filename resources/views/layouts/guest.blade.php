
<!doctype html>
<html class="fixed" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? $siteSetting->app_name }}</title>
		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <link href="{{asset('app').'/'.$siteSetting->favicon}}" rel="icon">
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		@include('layouts.pages.style')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body class="login-page-body-content">
		{{ $slot }}
	</body>
	@include('layouts.pages.script')
</html>
