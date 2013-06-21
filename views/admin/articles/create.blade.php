@extends('conferencer::layouts.admin')

@section('content')
	<p>&laquo; {{ HTML::linkRoute('admin.articles.index', 'Back to the list of articles') }}</p>

		@if (isset($item))
			{{ Former::horizontal_open_for_files(URL::route('admin.articles.update', $item->id))->method('PUT') }}
			{{ Former::legend('Modify article "' .$item->name. '"') }}
		@else
			{{ Former::horizontal_open_for_files(URL::route('admin.articles.store')) }}
			{{ Former::legend('Create an article') }}
		@endif

		{{ Former::text('name') }}
		@include('conferencer::partials.admin.toolbar')
		{{ Former::textarea('content')->addClass('textarea--large')->id('wysihtml5-textarea') }}

		{{-- Actions --}}
		{{ Former::actions()->large_primary_submit(isset($item) ? 'Modify' : 'Create') }}
	{{ Former::close() }}
@stop

@section('js')
	@parent
	@javascripts('wysihtml5.js')
@stop