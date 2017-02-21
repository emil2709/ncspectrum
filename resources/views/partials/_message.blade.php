@if(Session::has('success'))
	
	<div class="alert alert-success alert-dismissable alert-margin-top" role="alert">
	 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success! </strong> {{ Session::get('success') }}
	</div>

@endif

{{--
@if(count($error) > 0)

@endif
--}}