@extends('conferencer::layouts.admin')

@section('content')
	<p>&laquo; {{ HTML::linkRoute('admin.talks.index', 'Back to the list of talks') }}</p>

		@if (isset($item))
			{{ Former::horizontal_open_for_files(URL::route('admin.talks.update', $item->id))->rules(Talk::$rules)->method('PUT') }}
			{{ Former::legend('Modify talk "' .$item->name. '"') }}
		@else
			{{ Former::horizontal_open_for_files(URL::route('admin.talks.store'))->rules(Talk::$rules) }}
			{{ Former::legend('Create a talk') }}
		@endif

		<h3>Informations</h3>
		{{ Former::text('name') }}
		{{ Former::text('subname') }}
		@include('conferencer::partials.admin.toolbar')
		{{ Former::textarea('description')->addClass('textarea--large')->id('wysihtml5-textarea') }}

		{{ Former::legend('Dates') }}
		{{ Former::datetime('from')->help('Formatted as YYYY-mm-dd H:i:s') }}
		{{ Former::datetime('to')->help('Formatted as YYYY-mm-dd H:i:s') }}

		{{ Former::legend('Medias') }}
		{{ Former::text('youtube', 'Youtube playlist/video ID') }}
		{{ Former::text('flickr', 'Flickr set ID') }}
		{{ Former::textarea('links', 'Interesting links')->rows(12)
			->blockHelp('Formatted as<br><strong>Title;link<br>Title;link</strong>') }}

		{{ Former::legend('Tags') }}
		@if (isset($item))
			{{ Former::group('Tags') }}
				<div class="controls">
					<ul class="has-many" data-confirm="Are you sure you want to remove that tag from the talk ?">
							@foreach($item->tags as $tag)
								<li class="tag" data-id="{{ $tag->id }}">
									{{ $tag }} {{ HTML::linkAction('Conferencer\Controllers\Admin\TalksResource@removeTag', 'X', array($item->id, $tag->id)) }}
								</li>
							@endforeach
					</ul>
					{{ Former::select('tag')->fromQuery(Tag::orderBy('name', 'ASC')->get())->raw() }}
					{{ Former::primary_button('Add')->data_url(URL::action('Conferencer\Controllers\Admin\TalksResource@addTag', array($item->id, 0)))->addClass('has-many__add') }}
				</div>
			{{ Former::closeGroup() }}
		@endif

		@if (isset($item))
			{{ Former::group('Speakers') }}
				<div class="controls">
					<ul class="has-many" data-confirm="Are you sure you want to remove that speaker from the talk ?">
							@foreach($item->speakers as $speaker)
								<li class="tag" data-id="{{ $speaker->id }}">
									{{ $speaker }} {{ HTML::linkAction('Conferencer\Controllers\Admin\TalksResource@removeSpeaker', 'X', array($item->id, $speaker->id)) }}
								</li>
							@endforeach
					</ul>
					{{ Former::select('speaker')->fromQuery(Speaker::orderBy('name', 'ASC')->get())->raw() }}
					{{ Former::primary_button('Add')->data_url(URL::action('Conferencer\Controllers\Admin\TalksResource@addSpeaker', array($item->id, 0)))->addClass('has-many__add') }}
				</div>
			{{ Former::closeGroup() }}
		@endif

		<h3>Image</h3>
		@if (isset($item) and $item->image)
			{{ Former::group('Current image') }}
				<figure class="controls">
					{{ $item->thumb(300) }}
				</figure>
			{{ Former::closeGroup() }}
		@endif
		{{ Former::file('image') }}

		{{-- Actions --}}
		{{ Former::actions()->large_primary_submit(isset($item) ? 'Modify' : 'Create') }}
	{{ Former::close() }}
@stop

@section('js')
	@parent
	@javascripts('wysihtml5.js')
@stop