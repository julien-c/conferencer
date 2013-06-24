@extends('layouts.internal')

@section('title')
	@lang('navigation.news') -
@stop

@section('aside')
	<h3>Archives</h3>
	<ul class="calendar">
	@foreach ($calendar as $year => $months)
		<li>{{ $year }}
		<ul>
		@foreach ($months as $month => $days)
			<li>{{ $month }}
			<ul>
			@foreach ($days as $day => $date)
				@if (isset($thisDate) and $thisDate == $date)
					<li class="active">
				@else
					<li>
				@endif
					{{ HTML::linkAction('Conferencer\Controllers\ArticlesController@getArchives', $day, $date) }}
				</li>
			@endforeach
			</ul></li>
		@endforeach
		</ul></li>
	@endforeach
	</ul>

	<h3>On Twitter</h3>
	@include('partials.twitter-timeline')
@stop

@section('container-before')
	<h1>@lang('navigation.news')</h1>
@stop

@section('content')
	<section class="articles">
		@foreach ($articles as $article)
			<a href="{{ URL::action('Conferencer\Controllers\ArticlesController@getArticle', $article->slug, $article->slug) }}">
				<article class="content-list__item content-list__item--unicol">
					<div class="content-list__item__description">
						<h2 class="content-list__item__title">
							{{ $article->name }}
							<small>{{ $article->date }}</small>
						</h2>
						<p>{{ $article->getStripedAttribute('content') }}</p>
					</div>
				</article>
			</a>
		@endforeach
	</section>
@stop