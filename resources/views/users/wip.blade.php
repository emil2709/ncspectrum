@extends('main_user')

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
							<p class="lead text-center">
								New pages.
							</p>
							<hr>
							<p>
								La til tabellrepresentasjon av ansatte og admins. <br/>
								Oppdaterte endre og slette knappene og gjorde dem om til ikoner.
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<p class="lead text-center">
								Delete confirmation
							</p>
							<hr>
							<p>
								La til confirmation ved sletting av en bruker. 
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<p class="lead text-center">
								Validering
							</p>
							<hr>
							<p>
								Validering ble lagt til å de mest relevante stedene, regex kan derimot forbedres.
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('admins.guests') }}" class="btn btn-primary btn-block">GUESTS</a>
							<hr>
							<p>
								Admin kan nå legge til, endre og slette brukere. <br/>
								<strong>URL: /admins/users</strong>
							</p>
						</div>
					</div>
				</li>

				<li class="well col-md-6 col-md-offset-3">
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('admins.dashboard') }}" class="btn btn-primary btn-block">ADMINS DASHBOARD</a>
							<hr>
							<p>
								Admins oversiktsliste over brukere. <br/>
								<strong>URL: /admins/dashboard</strong>
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