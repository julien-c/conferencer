@extends('layouts.classic')

@section('title')
	@lang('navigation.speakers') 2012 -
@stop

@section('container-before')
	<h1>@lang('navigation.speakers') 2012</h1>
@stop

@section('aside')
	<section>
		<nav class="filters">
			<h4>Order by:</h4>
			<ul>
				<li><a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getIndex', 'latest') }}"><i class="icon-plus"></i> Latest talk</a></li>
				<li><a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getIndex', 'alpha') }}"><i class="icon-plus"></i> Alphabetical</a></li>
			</ul>
		</nav>
	</section>
@stop

@section('content')
	<div class="filters__results grid-speakers">
		@each('conferencer::partials.grid-speaker', $speakers, 'speaker')
	</div>
@stop