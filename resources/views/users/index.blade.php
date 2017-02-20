@extends('main')

@section('title', '| Home')

@section('content')

	<div class="container">
		<div class="row col-md-12">

			<div class="margin-top" id="welcome">
				<h1 class="text-center">Welcome to NC-Spectrum</h1>
			</div>

			<hr>
			<div class="col-md-5">
				<div class="margin-top" id="welcome">
					<h2 class="text-center">Out</h1>
					<hr/>
				</div>
				<ul class="sortable draggable connectedSortable">
					@foreach($users as $user)
					<li class="well">
						<div class="row">
							<div class="col-md-12">
								<div class="lead">
									{{$user->firstname}}
									{{$user->lastname}}
								</div>
								<hr>
								<div class="col-md-4">
									<label>Company: </label>
									<label>Email: </label>

								</div>
								<div class="col-md-8">
									{{$user->company}} <br/>
									{{$user->email}}
								</div>
							</div>
						</div>
					</li>
					@endforeach

				</ul>
			</div>

			<div class="divider"></div>

			<div class="col-md-5 col-md-offset-2">
				<div class="margin-top" id="welcome">
					<h2 class="text-center">In</h1>
					<hr/>
				</div>
				<ul class="sortable draggable connectedSortable">
					<li class="well">
						<div class="row">
							<div class="col-md-12">
								<p class="lead">
									Tmp
								</p>
								<hr>
								<p>
									Tmp
								</p>
							</div>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</div>

@endsection