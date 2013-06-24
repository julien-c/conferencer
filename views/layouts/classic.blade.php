@extends('conferencer::layouts.global')

@section('layout')
	<nav class="layout-navigation layout-navigation--small">
		@includeFallback('layouts.partials.navigation')
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

	@includeFallback('layouts.partials.footer')
@stop