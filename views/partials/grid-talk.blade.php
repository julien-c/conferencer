<figure>
	<a href="{{ URL::action('Conferencer\Controllers\TalksController@getTalk', $talk->slug) }}">
		{{ $talk->thumb(300) }}
		<figcaption>
			{{ $talk->name }}
		</figcaption>
	</a>
</figure>