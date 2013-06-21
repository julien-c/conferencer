@extends('layouts.global')

@section('title')
	Administration -
@stop

@section('css')
	@stylesheets('admin.css')
@stop

@section('layout')
	<section class="layout-container layout-container--admin">
		@if (Auth::check())
			<h2>
				Administration
				<small>Logged in as <em>{{ Auth::user()->username }}</em></small>
			</h2>
			@include('conferencer::partials.admin.navigation')
		@else
			<h2>Administration</h2>
		@endif

		@yield('container-before')
		<main class="layout-content">
			@yield('content')
		</main>
		@yield('container-after')
	</section>
@stop

@section('js')
	@javascripts('admin.js')
@stop