<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<title>@yield('title')</title>
	
	<!-- Bootstrap -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- JQuery UI -->
	<!-- Latest compiled CSS -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	
	<!-- Datatables -->
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/b-1.2.4/b-html5-1.2.4/fh-3.1.2/r-2.1.1/se-1.2.0/datatables.min.css"/> 

	<!-- Datatables -->
	<!-- Latest compiled and minified JavaScript -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/datatables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-1.10.13/b-1.2.4/b-html5-1.2.4/fh-3.1.2/r-2.1.1/se-1.2.0/datatables.min.js"></script>
	
	<!-- Our own custom css rules -->
	{{ Html::style('css/mainsheet.css') }}
	{{ Html::style('css/adminsheet.css') }}
	{{ Html::script('js/sort.js') }}

	<!-- Section used for pages that need specific additional css rules -->
    @yield('stylesheets')

</head>