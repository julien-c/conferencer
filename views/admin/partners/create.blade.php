@extends('layouts.admin')

@section('content')
	<p>&laquo; {{ HTML::linkRoute('admin.partners.index', 'Back to the list of partners') }}</p>

		@if (isset($item))
			{{ Former::horizontal_open_for_files(URL::route('admin.partners.update', $item->id))->method('PUT') }}
			{{ Former::legend('Modify partner "' .$item->name. '"') }}
		@else
			{{ Former::horizontal_open_for_files(URL::route('admin.partners.store')) }}
			{{ Former::legend('Create a partner') }}
		@endif

		{{ Former::text('name') }}
		{{ Former::select('type')->options(array(
			'classic' => 'Partner',
			'media'   => 'Media partner',
		)) }}
		@include('partials.admin.toolbar')
		{{ Former::textarea('description')->addClass('textarea--large')->id('wysihtml5-textarea') }}
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