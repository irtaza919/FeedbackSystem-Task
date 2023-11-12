<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- Meta data -->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="description" content="">
		
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>{{ config('app.name') }}</title>

		<!-- Style css -->
		<link href="{{URL::asset('theme/css/bootstrap.css')}}" rel="stylesheet" />
		<link rel="stylesheet" href="/theme/css/style.css">

	</head>

	<body style="background:#fff">

	<div class="container py-5">
	
	@yield('content')
		

	</div>
        
	</body>
</html>


