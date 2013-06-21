@extends('conferencer::layouts.admin')

@section('content')
	@if (Session::has('error'))
		<p class="alert alert-error">Your login or password was incorrect, please check and try again</p>
	@endif

	{{ Former::horizontal_open() }}
		{{ Former::legend('Login') }}
		{{ Former::text('username') }}
		{{ Former::password('password') }}
		{{ Former::actions()->large_primary_submit('submit') }}
	{{ Former::close() }}
@stop