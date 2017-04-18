<!-- 
Include all compiled plugins (below), or include individual files as needed.
These scripts are scripts that are not dependant on other stylesheets or javascript files in order to work propery,
hence placed at the bottom of the main sheets.
-->

<!-- Lastest compiled and minified JQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!-- Latest compiled and minified Bootstrap JavaScript Plugins -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Latest compiled and minifed Bootstrap Javascript Validator  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
<!-- Latest compiled Highcharts Javascript Plugin -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- Our own script for various behaviours and actions -->
{{ Html::script('js/adminscript.js') }}
{{ Html::script('js/jquery.tablesorter.min.js') }}
{{ Html::script('js/cake-highcharts.js') }}

