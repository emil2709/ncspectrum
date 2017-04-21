@if(Session::has('success'))	
	<div class="alert alert-success alert-margin-top text-center" role="alert">
		<strong>Success! </strong> <br/> {{ Session::get('success') }}
	</div>
@endif

@if(Session::has('user-success'))    
    <div class="alert alert-success text-center" role="alert">
        <h3>Thank You!</h3>
        {{ Session::get('user-success') }}
        <hr/>
        {{ HTML::image('images/logo.png', 'NC-Spectrum', ['class' => 'logo btn-margin-top']) }}
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger alert-margin-top text-center" role="alert">
        <strong>Error! </strong> <br/> {{ Session::get('error') }}
    </div>
@endif

@if(count($errors) > 0)
    <div class="alert alert-danger alert-margin-top text-center" role="alert"">
        <ul id="error" >
            <strong>Error! </strong>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif