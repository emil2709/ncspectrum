<!DOCTYPE html>
<html lang="en">

	@include('partials._adminhead')
	
	<body>
	
		@include('partials._nav')

		@include('partials._sidebar_left')

		<div class="container">

			@include('partials._message')

			@yield('content')

		</div>

		@include('partials._footer')

		@include('partials._javascript')	

	</body>

</html>