@extends('main_user')

@section('title', '| Home')

@section('content')

	<div class="container">
		<div class="row col-md-12">

			<div class="row" id="mainlogin">
				<div class='col-md-2 pull-right'>
					<a href='{{ route('users.create') }}' class='btn btn-primary btn-block'>CREATE NEW USER</a>
				</div>
			</div>

			<div class="row margin-top">
				<div class="col-md-5">
					<h2 class="text-center">CHECK OUT</h1>
					<hr/>
				</div>
				<div class="col-md-5 col-md-offset-2">
					<h2 class="text-center">CHECK IN</h1>
					<hr/>
				</div>
			</div>

			<div class="row margin-bottom">
				<div class="col-md-5 input-group" id="usersearch-div">        
			       <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
			       <input type="text" id="usersearch" class="form-control" placeholder="Name ...">
			    </div>
				<div class="col-md-5 pull-right"> 
			    	{!! Form::open(['route' => 'users.visit']) !!}
			        	{{ Form::submit('CHECK IN', ['class' => 'btn btn-success btn-block', 'id' => 'checkin-btn']) }}
			        {!! Form::close() !!}
			    </div>
			</div>
			
			<div class="row">
				<div class="col-md-5">
					<ul id="outlist" class="connectedSortable boxlist">
						@foreach($users as $user)
							<li id="outlist-box" class="userbox">
								<div id="userid" hidden>{{$user->id}}</div>
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
					<ul id="inlist" class="connectedSortable boxlist">					
					</ul>
				</div>
			</div>

		</div>
	</div>

@endsection