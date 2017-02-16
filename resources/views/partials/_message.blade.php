@if(Session::has('success'))
	
	<div class="alert alert-success" role="alert">
		<strong>Success! </strong> {{ Session::get('success') }}
	</div>

@endif

{{--
@if(count($error) > 0)

@endif
--}}