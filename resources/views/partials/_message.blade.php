@if(Session::has('success'))
	
	<div class="alert alert-success alert-dismissable alert-margin-top" role="alert">
	 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>Success! </strong> <br/> {{ Session::get('success') }}
	</div>

@endif

@if(Session::has('error'))
    
    <div class="alert alert-danger alert-dismissable alert-margin-top" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Error! </strong> <br/> {{ Session::get('error') }}
    </div>

@endif

@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable alert-margin-top" role="alert"">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul id="error" >
            <strong>Error! </strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif