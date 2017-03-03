@extends('main_user')

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
				<div class="input-group margin-bottom">        
			       <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
			       <input type="text" id="usersearch" class="form-control" placeholder="Search ...">
			       <input type="hidden" id="type" value="guests">
			    </div>
				<ul id="outlist" class="connectedSortable boxlist">
					@foreach($users as $user)
					<li id="outlist-box" class="userbox">
						<div class="row">
							<div class="col-md-12">
								<div class="text-center lead">
									<strong>
										{{$user->firstname}}
										{{$user->lastname}}
									</strong>
								</div>
								<div class="col-md-12 text-center">
									{{$user->email}} <br/>
									{{$user->company}}
								</div>
							</div>
						</div>
					</li>
					@endforeach

				</ul>
				
			</div>

			<div class="col-md-5 col-md-offset-2">
				<div class="margin-top" id="welcome">
					<h2 class="text-center">In</h1>
					<hr/>
				</div>
				<ul id="inlist" class="connectedSortable boxlist">					
				</ul>
			</div>

		</div>
	</div>

@endsection