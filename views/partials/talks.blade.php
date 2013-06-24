<section class="content-list">
	@foreach ($talks as $talk)
		<article class="content-list__item">
			<a href="{{ URL::action('Conferencer\Controllers\TalksController@getTalk', $talk->slug) }}">
				<time class="content-list__item__time">
					{{ $talk->date }}
					<time>{{ $talk->time }}</time>
					<section class="tags">
						@foreach ($talk->tags as $tag)
							<span class="tag">
								#{{ $tag->name }}
							</span>
						@endforeach
					</section>
				</time>
				<figure class="content-list__item__image">
					@if ($talk->thumb())
						{{ $talk->thumb()->alt($talk->name) }}
					@endif
				</figure>
				<div class="content-list__item__description">
					<h3 class="content-list__item__title">
						{{ $talk->name }}
						<small>{{ $talk->subname }}</small>
					</h3>
					<p>
						{{ Str::words($talk->description, 25) }}
					</p>
				</div>
			</a>
		</article>
	@endforeach
</section>