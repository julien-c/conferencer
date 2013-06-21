@extends('conferencer::layouts.admin')

@section('title')
	{{ ucfirst($namespace) }} administration -
@stop

@section('content')
	<table class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				@foreach ($columns as $column)
					@if (Str::contains($column, '_id'))
						<th>{{ ucfirst(str_replace('_id', null, $column)) }}</th>
					@else
						<th>{{ ucfirst($column) }}</th>
					@endif
				@endforeach
				<th>Edit</th>
				<th>Delete</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($items as $item)
				<tr>
					@foreach ($columns as $column)
						<td>{{ $item->getStripedAttribute($column, 10) }}</td>
					@endforeach
					<td>{{ HTML::linkRoute('admin.' .$namespace. '.edit', 'Edit', $item->id) }}</td>
					<td data-confirm="Are you sure you want to delete this {{ Str::singular($namespace) }} ?" data-action="delete">{{ HTML::linkRoute('admin.' .$namespace. '.destroy', 'Delete', $item->id) }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ URL::route('admin.' .$namespace. '.create') }}" class="btn btn-large btn-primary btn-block">Create a new {{ Str::singular($namespace) }}</a>
@stop