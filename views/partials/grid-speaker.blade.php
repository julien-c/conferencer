<article class="speaker">
	<a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getSpeaker', $speaker->slug) }}">
		<figure>
			{{ $speaker->thumb(300) }}
		</figure>
		<div class="speaker__body">
			<h4>{{ $speaker->name }}</h4>
			<p>{{ $speaker->role }}</p>
		</div>
	</a>
</article>