@extends('conferencer::layouts.admin')

@section('content')
	Welcome, {{ Auth::user()->username }}.
@stop