@extends('main')

@section('title', '| Home')

@section('content')

	<div class="container">
		<div class="row col-md-12">

			<div class="margin-top" id="welcome">
				<h1 class="text-center">Welcome Nigga..</h1>
			</div>

			<div class="row margin-top">
				<p class="lead">
					Yalla section containing work in progress
				</p>
			</div>

			<hr>

			<ul class="sortable draggable">
				<li>
					<div class="row">
						<div class="col-md-6">
							<div class="well">
								<p class="lead">
									Drag
								</p>
								<hr>
								<p>
									Drag the wells bitch.
								</p>
							</div>
						</div>
					</div>
				</li>

				<li>
					<div class="row">
						<div class="col-md-6">
							<div class="well">
								<a href="{{ route('users.create') }}" class="btn btn-primary btn-block">Create new user</a>
								<hr>
								<p>
									Knappen for å lage en bruker. <br/>
									Kan registrere en bruker som blir lagret til databasen uten problemer. <br/>
									Burde derimot se litt så design.
								</p>
							</div>
						</div>
					</div>
				</li>

				<li>
					<div class="row">
						<div class="col-md-6">
							<div class="well">
								<a href="{{ route('login') }}" class="btn btn-primary btn-block">Admin login</a>
								<hr>
								<p>
									Knappen for å logge inn som admin. <br/>
									Funker ikke. Designet burde forbedret mye mer >>!
								</p>
							</div>
						</div>
					</div>
				</li>
			</ul>

		</div>
	</div>

@endsection