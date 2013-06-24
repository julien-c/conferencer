@if ($talk->youtube)
	<div class="talk__medias__youtube">
		@if ($talk->hasYoutubePlaylist)
			<iframe width="640" height="360" src="http://www.youtube.com/embed/videoseries?list={{ $talk->youtube }}" frameborder="0" allowfullscreen></iframe>
		@else
			<iframe width="640" height="360" src="http://www.youtube.com/embed/{{ $talk->youtube }}" frameborder="0" allowfullscreen></iframe>
		@endif
	</div>
@endif