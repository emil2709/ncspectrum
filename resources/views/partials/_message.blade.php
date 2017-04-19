@if(Session::has('success'))	
	<div class="alert alert-success alert-margin-top" role="alert">
		<strong>Success! </strong> <br/> {{ Session::get('success') }}
	</div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-margin-top" role="alert">
        <strong>Error! </strong> <br/> {{ Session::get('error') }}
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-danger alert-margin-top" role="alert"">
        <ul id="error" >
            <strong>Error! </strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif