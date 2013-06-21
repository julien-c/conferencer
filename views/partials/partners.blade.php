@foreach ($partners as $partner)
	<article class="partner">
		<aside>
			{{ HTML::image($partner->imagePath) }}
		</aside>
		<div>
			{{ nl2br($partner->description) }}
		</div>
	</article>
@endforeach
<h1>Media Partners</h1>
@foreach ($mediaPartners as $mediaPartner)
	<article class="partner--media">
		{{ HTML::image($mediaPartner->imagePath) }}
	</article>
@endforeach