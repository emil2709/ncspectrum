@extends('main')

@section('title', '| Work In Progress Section')

@section('content')

	<div class="container">
		<div class="row col-md-12">

			<div class="margin-top" id="welcome">
				<h1 class="text-center">Welcome to <i>'The Work In Progress Section'</i></h1>
			</div>

			<div class="row margin-top">
				<p class="lead text-center">
					Work in Progress Section
				</p>
			</div>

			<hr>

			<ul class="sortable draggable">

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('admins.overview') }}" class="btn btn-primary btn-block">ADMINS OVERVIEW</a>
							<hr>
							<p>
								Admins oversiktsliste over brukere. <br/>
								<strong>URL: /admins/overview</strong>
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('users.index') }}" class="btn btn-primary btn-block">USER HOMEPAGE</a>
							<hr>
							<p>
								Hjemmesiden for besøkende der de kan dra seg inn/ut. <br/>
								<strong>URL: /index</strong>
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<p class="lead text-center">
								Foreignkey and Seed fix
							</p>
							<hr>
							<p>
								Fixed the foreign keys and made seeds.
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<p class="lead text-center">
								DRAG
							</p>
							<hr>
							<p>
								Drag the wells.
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">		
							<p class="lead text-center">
								FLASH MESSAGE
							</p>
							<hr>
							<p>
								En "Success" flash-message vil nå vises etter at en user har blitt opprettet.
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('users.create') }}" class="btn btn-primary btn-block">CREATE NEW USER</a>
							<hr>
							<p>
								Knappen for å lage en bruker. <br/>
								Kan registrere en bruker som blir lagret til databasen uten problemer. <br/>
								Burde derimot se litt så design. <br/>
								<strong>URL: /create</strong>
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('login') }}" class="btn btn-primary btn-block">ADMIN LOGIN</a>
							<hr>
							<p>
								Knappen for å logge inn som admin. <br/>
								Selve innloggingen er ikke laget enda. <br/>
								Designet burde forbedret mye mer >>! <br/>
								<strong>URL: /auth/login</strong>
							</p>
						</div>
					</div>
				</li>

			</ul>

		</div>
	</div>

@endsection