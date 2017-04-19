/**
 * Dynamic Alerts
 *
 * This global timeout is set to make the Bootstrap alerts more dynamic.
 * After a set time of appearance the alert boxes will begin to slide up and disappear. 
 * This function is global and will toggle on every page where the alerts appear.
 */
window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
  });
}, 4000);


/**
 * Table Sorter
 *
 * A function that runs after the document has finished loading. 
 * This function is required to run in order for the script 
 * "jquery.tablesorter.min.js", aka the jquery tablesorting to function properly.
 * This function is used on pages with a table.
 */
$(document).ready(function(){ 
  $("#myTable").tablesorter({dateFormat: "uk"}); 
}); 

$(document).ready(function(){ 
  if($('#dashboard-status tr').length == 0)
  {
    $('#dashboard-status').html('<tr><td class="faint-placeholder"><i>(Currently no checked-in guests)</i></td></tr>');
  }
});

/**
 * Upload Avatar Button 
 *
 * Clicked in order to hide the "Update Avatar" button and trigger/show the hidden upload functions.
 * This function is used in the "profile.blade.php" page.
 */
$('#updateAvatarToggle').click(function(){
  $(this).hide();
});

/**
 * Upload Avatar Button Sync
 *
 * Function is used in order to synchronize the appearance and disappearance of
 * the "Update Avatar" button and the toggled upload functions, respectively.
 * This function is used in the "profile.blade.php" page.
 */
$('#updateAvatarCancel').click(function(){
  $('#updateAvatarToggle').delay(600).show(0);
});

/**
 * Upload Avatar Check
 *
 * Function is a client-sided check to see if the user has uploaded an avatar.
 * If not, the function will return false and the user will not be able to procceed to upload nothing.
 * This function is used in the "profile.blade.php" page.
 */
$('#updateAvatarSave').click(function(){
  var filename = $('#avatar').val();
  if(filename == "")
  {
    return false;
  }
});

/**
 * Prehidden Guestlist Section
 *
 * This function is used to prehide the guest-list on certain pages with a table, 
 * to allow them to be toggled and shown when the user wishes for it.
 * This function is used in "employeeVisits.blade.php" and "visits.blade.php".
 */
$(".guest-expansion").hide();


/**
 * Guestlist Section Toggle
 *
 * This function is used to toggle the guestlist section.
 * Depending on the toggle status the color of the icon will change. 
 * There is also a delay set in order to synchronize the timing of disappearance and 
 * appearance of the guestlist section and placeholder text respectively.
 * This function is used in "employeeVisits.blade.php" and "visits.blade.php".
 */
$(".guest-expansion-btn").click(function(event) 
{
  if($(this).siblings('.faint-placeholder').is(':visible'))
  {
    $(this).siblings('.faint-placeholder').hide();
    $(this).children('#expansion-icon').css('color', '#55c43b');
  }
  else
  {
    $(this).siblings('.faint-placeholder').delay(600).show(0);
    $(this).children('#expansion-icon').css('color', '#00adef');
  }
  $(this).siblings('.guest-expansion').slideToggle('slow');
});

/**
 * Livesearch 
 *
 * This is an AJAX function that allows us to do livesearch.
 * This function will listen to livesearch-inputfields and send the typed letters in real time to 
 * preform a livesearch in the connected database and return the found results.
 * This function is used on most pages with a table.
 * This function is connected to the "AdminController" with method "search()".
 */
$('#search').on('keyup',function(){
  // Gets the values/letters that is typed in the livesearch-field.
  $search = $(this).val();
  // Sends the values to the controller to preform a livesearch.
  $type = $('#type').val();
  $.ajax({
    type: 'get',
    url: '/search',
    data: {'search':$search,'type':$type},
    success:function(data)
    {
      // Result will replace the contents of the written ID.
      $('#searchresult').html(data);
    }

  });
});