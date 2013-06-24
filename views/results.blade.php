@extends($layoutUnicol)

@section('title')
	@if (isset($tag))
		{{ $tag->name }} -
	@else
		Talks -
	@endif
@stop

@section('content')

	{{-- Tag --}}
	@if (isset($tag))
		<h1>{{ $tag->name }}</h1>
	@endif

	{{-- Talks --}}
	@if (isset($talks))
		<h2>{{ $talks->count(). ' ' .Str::plural('Talk', $talks->count()) }}</h2>
		@includeFallback('partials.talks')
	@endif

	{{-- Speakers --}}
	@if (isset($speakers))
		<h2>{{ $speakers->count(). ' ' .Str::plural('Speaker', $speakers->count()) }}</h2>
		<section class="content-list">
			@foreach ($speakers as $speaker)
				<article class="content-list__item speaker-list__speaker">
					<figure class="content-list__item__image">
						{{ HTML::image($speaker->imagePath) }}
					</figure>
					<div class="content-list__item__description">
						<a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getSpeaker', $speaker->slug) }}">
							<h3 class="content-list__item__title">
								{{ $speaker->name }}
								<small>{{ $speaker->role }}</small>
							</h3>
						</a>
						<p>{{ Str::words($speaker->biography, 25) }}</p>
					</div>
				</article>
			@endforeach
		</section>
	@endif
@stop