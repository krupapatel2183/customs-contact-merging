<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	{{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
	<title>Hotel Dashboard Template</title>
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
    @include('includes.css-links')
	
</head>

<body>
	<div class="main-wrapper">
		@include('includes.header')
        @include('includes.leftmenu')
		@yield('content')
	</div>

    <!-- All javascript and jquery are included here -->
    @include('includes.flash-message')
    @include('includes.javascripts')
    @stack('custom-scripts')
</body>

</html>