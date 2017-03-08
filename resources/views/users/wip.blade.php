@extends('main_user')

@section('title', '| Work In Progress Section')

@section('content')

	<div class="container">
		<div class="row col-md-12">

			<div class="margin-top" id="welcome">
				<h1 class="text-center">Welcome to <i>'The Work In Progress Section'</i></h1>
			</div>

			<div class="col-md-12 margin-top">
				<p class="lead text-center">Guest function</p>
				<hr/>
			</div>

			<ul class="wipbox col-md-12 col-md-offset-1" id="sortable">

				<li class="well col-md-3 outerpadding">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('users.index') }}" class="btn btn-primary btn-block">USER HOMEPAGE</a>
						</div>
					</div>
				</li>

				<li class="well col-md-3 outerpadding">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('users.create') }}" class="btn btn-primary btn-block">CREATE NEW USER</a>
						</div>
					</div>
				</li>

			</ul>

			<div class="col-md-12 margin-top">
				<p class="lead text-center">Admin function</p>
				<hr/>
			</div>

			<ul class="wipbox col-md-12 col-md-offset-1" id="sortable">

				<li class="well col-md-3 outerpadding">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('admins.dashboard') }}" class="btn btn-primary btn-block">ADMINS DASHBOARD</a>
						</div>
					</div>
				</li>


				<li class="well col-md-3 outerpadding">
					<div class="row">
						<div class="col-md-12">
							<a href="{{route('login')}}" class="btn btn-primary btn-block">ADMIN LOGIN</a>
						</div>
					</div>
				</li>

			</ul>

		</div>
	</div>

@endsection