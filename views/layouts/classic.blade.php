@extends('conferencer::layouts.global')

@section('layout')
	<nav class="layout-navigation layout-navigation--small">
		@if (View::exists('layouts.partials.footer'))
			@include('layouts.partials.navigation')
		@else
			@include('conferencer::layouts.partials.navigation')
		@endif
	</nav>

	<section class="layout-container @yield('container-classes')">
		@yield('container-before')
		<aside class="layout-aside">
			@yield('aside')
		</aside>
		<main class="layout-content">
			@yield('content')
		</main>
		@yield('container-after')
	</section>

	@if (View::exists('layouts.partials.footer'))
		@include('layouts.partials.footer')
	@else
		@include('conferencer::layouts.partials.footer')
	@endif
@stop