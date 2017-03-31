@extends('main_user')

@section('title', '| Home')

@section('content')
		<div class="row">

			<div class="col-md-12" id="mainlogin">
				<div class='col-md-2 pull-right'>
					<a href='{{ route('users.create') }}' class='btn btn-primary btn-block'>CREATE NEW USER</a>
				</div>
				<div class='col-md-2 pull-right'>
					<button id="printer" class='btn btn-primary btn-block'>PRINTER</button>
				</div>
			</div>

			<div class="col-md-6 margin-top">
				<div class="col-md-12">
					<h2 class="text-center">CHECK OUT</h1>
					<hr/>
				</div>
				<div class="col-md-12 margin-bottom">
					<div class="input-group" id="usersearch-div">        
				       <span class="input-group-addon" id="search-addon"><i class="glyphicon glyphicon-search"></i></span>
				       <input type="text" id="usersearch" class="form-control" placeholder="Name ...">
				    </div>
				</div>
				<div class="col-md-12">
					<ul id="outlist" class="connectedSortable boxlist">
					@foreach($usersout as $userout)
						<li class="userbox" id="out">
							<div id="userid" hidden>{{$userout->id}}</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center lead">
										<strong>
											{{$userout->firstname}}
											{{$userout->lastname}}
										</strong>
									</div>
									<div class="col-md-12 text-center">
										{{$userout->email}} <br/>
										{{$userout->company}}
									</div>
								</div>
							</div>
						</li>
					@endforeach
					</ul>	
				</div>
			</div>

			<div class="col-md-6 margin-top">
				<div class="col-md-12">
					<h2 class="text-center">CHECK IN</h1>
					<hr/>
				</div>
				<div class="col-md-12 margin-bottom">
					<div> 
				        {{ Form::submit('CHECK IN', ['class' => 'btn btn-success btn-block', 'id' => 'checkin-btn']) }}
				    </div>
				</div>
				<div class="col-md-12">
					<ul id="inlist" class="connectedSortable boxlist">		
					@foreach($usersin as $userin)
						<li class="userbox-in" id="in">
							<div id="userid" hidden>{{$userin->id}}</div>
							<div class="row">
								<div class="col-md-12">
									<div class="text-center lead">
										<strong>
											{{$userin->firstname}}
											{{$userin->lastname}}
										</strong>
									</div>
									<div class="col-md-12 text-center">
										{{$userin->email}} <br/>
										{{$userin->company}}
									</div>
								</div>
							</div>
						</li>
					@endforeach					
					</ul>
				</div>
			</div>
			
		</div>
@endsection