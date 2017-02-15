@extends('main')

@section('title', '| Home')

@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="well">
				<h1 class="text-center">Welcome</h1>
			</div>
		</div>
	</div>

	<div class="row">
		Yalla ting
	</div>
	<div class="row">
		<a href="{{ route('create') }}" class="btn btn-primary">Create new user</a>
	</div>

@endsection