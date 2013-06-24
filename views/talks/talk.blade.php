@extends($layoutClassic)

@section('title')
	{{ $talk->name }} -
@stop

@section('container-classes') layout-container--talk @stop

@section('container-before')
	<nav class="timeline timeline--small flexbox--last">
		@include('conferencer::partials.timeline-controls')
		<ul class="timeline__container">
			@foreach($talk->relatedTalks() as $relatedTalk)
				@if ($relatedTalk->from == $talk->from)
					<li class="timeline__item active">
				@else
					<li class="timeline__item">
				@endif
						<time class="timeline__item__date">{{ $relatedTalk->from->format('H:i') }}</time>
						{{ HTML::linkAction('Conferencer\Controllers\TalksController@getTalk', $relatedTalk->name, $relatedTalk->slug) }}
					</li>
			@endforeach
		</ul>
	</nav>

	<h1 class="block-title">
		{{ $talk->name }}
		<small>{{ $talk->subname }}</small>
	</h1>
@stop

@section('aside')
	<section>
		<time datetime="{{ $talk->from->format('Y-m-d H:i:s') }}">
			{{ $talk->from->format('l, d M Y') }}<br>{{ $talk->from->format('H:i') }}
		</time> -
		@if ($talk->to)
			<time datetime="{{ $talk->to->format('Y-m-d H:i:s') }}">
				{{ $talk->to->format('H:i') }}
			</time>
		@endif
	</section>
	@if (strlen($talk->description) > 5)
		<section>
			<h3>What's it about?</h3>
			<div class="talk__description--short">
				{{ Str::words($talk->description, 15) }}
				<p class="read-more">
					<a href="#" data-show=".talk__description">Read more</a>
				</p>
			</div>
			<div class="talk__description">
				{{ $talk->description }}
				<p class="read-more">
					<a href="#" data-show=".talk__description--short">Read less</a>
				</p>
			</div>
		</section>
	@endif
	@if ($talk->links)
		<section class="talk__links">
			<h3>Interesting links</h3>
			<ul>
				@foreach ($talk->interestingLinks as $link)
					<li>
						<a href="{{ $link->url }}">
							{{ $link->title }}
						</a>
					</li>
				@endforeach
			</ul>
		</section>
	@endif
@stop

@section('content')
	<section class="talk">
		<main class="talk__content">
			<div class="grid-speakers">
				@each('conferencer::partials.grid-speaker', $talk->speakers, 'speaker')
			</div>
			@if (!$talk->tags->isEmpty())
				<h3>Tags</h3>
				@foreach ($talk->tags as $tag)
					{{ HTML::linkAction('Conferencer\Controllers\TalksController@getTag', '#'.$tag->name, $tag->name, array('class' => 'tag')) }}</a>
				@endforeach
			@endif
		</main>
	</section>
@stop

@section('container-after')
	<section class="talk__medias">
		@if ($talk->youtube or $talk->flickr)
			<h3>Medias</h3>
		@endif
		{{ $talk->youtubeEmbed }}
		@if ($talk->flickr)
			<div class="talk__medias__flickr">
				<object width="700" height="525">
					<param name="flashvars" value="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F{{ $flickr }}%2Fsets%2F{{ $talk->flickr }}%2Fshow%2F&page_show_back_url=%2Fphotos%2F{{ $flickr }}%2Fsets%2F{{ $talk->flickr }}%2F&set_id={{ $talk->flickr }}&jump_to="></param>
					<param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=124984"></param>
					<param name="allowFullScreen" value="true"></param>
					<embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=124984" allowFullScreen="true" flashvars="offsite=true&lang=en-us&page_show_url=%2Fphotos%2F{{ $flickr }}%2Fsets%2F{{ $talk->flickr }}%2Fshow%2F&page_show_back_url=%2Fphotos%2F{{ $flickr }}%2Fsets%2F{{ $talk->flickr }}%2F&set_id={{ $talk->flickr }}&jump_to=" width="700" height="525"></embed>
				</object>
			</div>
		@endif
	</section>
@stop