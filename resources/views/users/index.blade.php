@extends('main')

@section('title', '| Home')

@section('content')

	<div class="container">
		<div class="row col-md-12">
			<div class="well" id="welcome">
				<h1 class="text-center">Welcome Nigga..</h1>
			</div>
			<div class="row">
				Yalla knapper og ting
			</div>
			<div class="row">
				<a href="{{ route('users.create') }}" class="btn btn-primary">Create new user</a>
			</div>
		</div>
	</div>

@endsection