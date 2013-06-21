@extends('layouts.internal')

@section('title')
	@lang('navigation.program') {{ $year }} -
@stop

@section('container-before')
	<h1>@lang('navigation.program') {{ $year }}</h1>
@stop

@section('aside')
	<section class="print-hidden">
		<a class="program-pdf" href="{{ URL::action('Conferencer\Controllers\TalksController@getProgramPdf', $year) }}" target="_blank">
			Download program as PDF
		</a>
	</section>
	<!-- <nav class="print-hidden">
		<h3>Filter by</h3>
		<ul>
			{{-- Categories --}}
		</ul>
	</nav> -->
@stop

@section('content')
	@include('partials.program-timeline')

	{{-- Days --}}
	<ul class="timeline tabs">
		@foreach ($days as $thisDay)
			@if ($day == $thisDay)
				<li class="timeline__item active">
			@else
				<li class="timeline__item ">
			@endif
				{{ HTML::link(
					'#'.$year.'-'.$month.'-'.$thisDay,
					Carbon::create($year, $month, $thisDay)->toFormattedDateString()) }}
			</li>
		@endforeach
	</ul>

	{{-- Day timeline --}}
	@foreach ($program as $date => $talks)
		<section id="{{ $date }}" class="tab-pane <?php if ($date == $year.'-'.$month.'-'.$day) echo "active" ?> program">
			<h2 class="block-title">
				{{ Carbon::createFromFormat('Y-m-d', $date)->format('l, d M Y') }}
			</h2>
			<p class="content-list__empty alert alert-info">There is no talk matching the selected filters</p>
			<div class=" content-list">
			@foreach ($talks as $talk)
				<article class="content-list__item" data-category="">
					<time class="content-list__item__time">
						{{ $talk->from->format('H:i') }}<br>
						<section class="tags">
							@foreach ($talk->tags as $tag)
								<a href="{{ URL::action('Conferencer\Controllers\TalksController@getTag', $tag->name) }}" class="tag">
									#{{ $tag->name }}
								</a>
							@endforeach
						</section>
					</time>
					<div class="content-list__item__description">
						<h3 class="content-list__item__title">
							{{ HTML::linkAction('Conferencer\Controllers\TalksController@getTalk', $talk->name, $talk->slug) }}
							<small>{{ $talk->subname }}</small>
						</h3>

						<ul class="speakers-list">
							@foreach ($talk->speakers as $speaker)
								<li class="speaker-list__speaker">
									<a href="{{ URL::action('Conferencer\Controllers\SpeakersController@getSpeaker', $speaker->slug) }}">
										<figure class="speaker-list__speaker__image">
											{{ HTML::image($speaker->imagePath) }}
										</figure>
										<div class="speaker-list__speaker__content">
											<h3 class="content-list__item__title">
												{{ $speaker->name }}
												<small>{{ $speaker->role }}</small>
											</h3>
										</div>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</article>
			@endforeach
			</div>
		</section>
	@endforeach

@stop