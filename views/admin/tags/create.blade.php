@extends('conferencer::layouts.admin')

@section('content')
	<p>&laquo; {{ HTML::linkRoute('admin.tags.index', 'Back to the list of tags') }}</p>

		@if (isset($item))
			{{ Former::horizontal_open_for_files(URL::route('admin.tags.update', $item->id))->method('PUT') }}
			{{ Former::legend('Modify tag "' .$item->name. '"') }}
		@else
			{{ Former::horizontal_open_for_files(URL::route('admin.tags.store')) }}
			{{ Former::legend('Create a tag') }}
		@endif

		{{ Former::text('name') }}

		{{-- Actions --}}
		{{ Former::actions()->large_primary_submit(isset($item) ? 'Modify' : 'Create') }}
	{{ Former::close() }}
@stop