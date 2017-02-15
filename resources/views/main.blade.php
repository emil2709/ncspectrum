<!DOCTYPE html>
<html lang="en">

	@include('partials._head')

	<body>
		
		<div class="container">

			@include('partials._message')

			@yield('content')
			
		</div>

	@include('partials._footer')

	@include('partials._javascript')	

	</body>

</html>