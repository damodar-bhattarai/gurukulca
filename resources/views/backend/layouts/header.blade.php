<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{ env('APP_NAME') }}" />
		<meta property="og:url" content="{{ url('/') }}" />
		<meta property="og:site_name" content="{{ env('APP_NAME') }}" />
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{ asset('css/backend/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('css/backend/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <script src="//unpkg.com/alpinejs" defer></script>

         <!-- Styles -->
         <link rel="stylesheet" href="{{ asset('css/app.css') }}">


         <!-- Scripts -->
         <script src="{{ asset('js/backend/plugins.bundle.js') }}"></script>
         <script src="{{ asset('js/backend/scripts.bundle.js') }}"></script>
         <script src="{{ asset('js/app.js') }}" defer></script>
         <style>
            .form-control{
                background-color: #f5f8fa;
                border-color: #f5f8fa;
                color: #5e6278;
                transition: color .2s ease,background-color .2s ease;
            }
        </style>
         @livewireStyles

         @stack('styles')
	</head>
    <!--end::Head-->
