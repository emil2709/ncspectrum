<!DOCTYPE html>
<html lang="en">

	@include('partials._adminhead')
	
	<body>
		@include('partials._nav')

		<div class="col-sm-3 col-lg-2 sidebar">
			@include('partials._sidebar_left')
		</div>

		<div class="container">
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				@include('partials._message')
				@yield('content')
			</div>
		</div>

		@include('partials._footer')

		@include('partials._adminjavascript')	
	</body>

</html>