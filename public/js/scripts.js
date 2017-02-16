
// JQuery actions triggered on load

$(document).ready(function(){

	// Functions triggered on load
	$("#welcome").hide().fadeIn(3000);


	// Interactive functions
	$( function() {
    	$( ".sortable" ).sortable({
      		revert: true
    	});
    	$( ".draggable" ).draggable({
      		connectToSortable: ".sortable",
      		revert: "invalid"
    	});
    	$( "ul, li" ).disableSelection();
  	});

});