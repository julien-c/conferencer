@extends('conferencer::layouts.admin')

@section('content')
	<p>&laquo; {{ HTML::linkRoute('admin.speakers.index', 'Back to the list of speakers') }}</p>

		@if (isset($item))
			{{ Former::horizontal_open_for_files(URL::route('admin.speakers.update', $item->id))->method('PUT') }}
			{{ Former::legend('Modify speaker "' .$item->name. '"') }}
		@else
			{{ Former::horizontal_open_for_files(URL::route('admin.speakers.store')) }}
			{{ Former::legend('Create a speaker') }}
		@endif

		{{ Former::text('name') }}
		{{ Former::text('role') }}
		@include('conferencer::partials.admin.toolbar')
		{{ Former::textarea('biography')->addClass('textarea--large')->id('wysihtml5-textarea') }}
		{{ Former::text('website') }}
		{{ Former::text('twitter') }}
		{{ Former::text('facebook') }}
		@if (isset($item) and $item->image)
		{{ Former::group('Current image') }}
			<figure class="controls">
				{{ HTML::image($item->imagePath) }}
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