<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title'){{ $title }}</title>
	<meta name="viewport" content="width=device-width">
	<link href="{{ URL::asset('app/img/favicon.png') }}" rel="shortcut icon"/>
	{{ HTML::script('packages/anahkiasen/conferencer/js/modernizr.min.js') }}
	{{ HTML::script('packages/anahkiasen/conferencer/js/polyfill.js') }}
	@section('css')
		@stylesheets('application.css')
		{{ HTML::style('app/css/print.css', array('media' => 'print')) }}
	@show
</head>
<body class="@yield('classes')">
	<div class="layout-footer__wrapper">
		@yield('layout')
		@include('partials.footer')
	</div>

	@if ($typekit)
		<script type="text/javascript" src="//use.typekit.net/{{ $typekit }}.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	@endif
	@section('js')
		@javascripts('application.js')
	@show
</body>
</html>