@extends('layouts.internal')

@section('title')
	{{ $speaker->name }} -
@stop

@section('container-before')
	<div class="print-hidden">
		&laquo; {{ HTML::linkAction('Conferencer\Controllers\SpeakersController@getIndex', 'Back to speakers') }}
	</div>
	<h1 class="block-title">
		{{ $speaker->name }}
		<small>{{ $speaker->role }}</small>
	</h1>
@stop

@section('aside')
	<!-- <section>
		<h2>Quotes</h2>
		<blockquote>{{ App::make('faker')->sentence }}</blockquote>
	</section> -->

	@if (!$speaker->relatedSpeakers()->isEmpty())
		<section class="speaker__related-speakers">
			<h2>Related speakers</h2>
			@foreach ($speaker->relatedSpeakers() as $relatedSpeaker)
				<a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getSpeaker', $relatedSpeaker->slug) }}">
					<figure data-toggle="tooltip" title="{{ $relatedSpeaker->name }}">
						{{ $relatedSpeaker->thumb(50) }}
					</figure>
				</a>
			@endforeach
		</section>
	@endif

	<section>
		<h2>Follow this speaker</h2>
		<dl>
			@foreach ($speaker->contact as $type => $url)
				<dt>{{ Str::upper($type) }}</dt>
				<dd>
					<a href="{{ $url }}" target="_blank">
						{{ $speaker->$type }}
					</a>
				</dd>
			@endforeach
		</dl>
	</section>
@stop

@section('content')
	<article class="speaker">
		{{-- Speaker informations --}}
		<div class="speaker__content">
			<figure class="speaker__image">
				{{ HTML::image($speaker->imagePath) }}
			</figure>
			<p class="speaker__description">{{ $speaker->biography }}</p>
			@if (!$speaker->tags()->isEmpty())
				<div class="speaker__tags">
					<h3>Tags</h3>
					@foreach ($speaker->tags() as $tag)
						{{ HTML::linkAction('Conferencer\Controllers\TalksController@getTag', '#'.$tag->name, $tag->name, array('class' => 'tag')) }}</a>
					@endforeach
				</div>
			@endif
		</div>
	</article>
@stop

@section('container-after')
	<h2 style="clear: both">Related talks</h2>
	@if (!$speaker->talks->isEmpty())
		@include('partials.talks', array('talks' => $speaker->talks))
	@else
		<p class="color-mute">
			This speaker doesn't have any talks
		</p>
	@endif
@stop