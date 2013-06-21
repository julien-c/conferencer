@extends('layouts.unicol')

@section('title')
	{{ $article->name }} -
@stop

@section('content')
	<p>&laquo; {{ HTML::linkAction('Conferencer\Controllers\ArticlesController@getIndex', 'Back to articles') }}</p>

	<nav class="timeline timeline--small flexbox--last">
		@include('partials.timeline-controls')
		<ul class="timeline__container">
			@foreach ($articles as $timelineArticle)
				@if ($timelineArticle->id == $article->id)
				<li class="timeline__item active">
				@else
				<li class="timeline__item ">
				@endif
					<time class="timeline__item__date">{{ $timelineArticle->created_at->format('Y-m-d') }}</time>
					{{ HTML::linkAction('Conferencer\Controllers\ArticlesController@getArticle', $timelineArticle->name, $timelineArticle->slug) }}
				</li>
			@endforeach
		</ul>
	</nav>

	<h1 class="block-title flexbox--first">{{ $article->name }}</h1>
	<section class="article flexbox--first">
		{{ nl2br($article->content) }}
		<div class="article__infos">
			by <strong>{{ $article->user->fullname }}</strong><br>
			<time>
				{{ $article->created_at }}
			</time>
		</div>
	</section>
@stop