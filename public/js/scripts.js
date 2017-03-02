
$(document).ready(function(){

  $("#welcome").hide().fadeIn(3000);

  // Userinteractions

  $("#outlist, #inlist").sortable({
      revert: true,
      connectWith: ".connectedSortable"
  }).disableSelection();
  
  /*
  $("#outlist-box").click(function(){
    $('#inlist').append($(this).removeClass(this));
    $(this).attr('id', 'inlist-box');
  });

  $("#inlist-box").click(function(){
    $('#outlist').append($(this).removeClass(this));
    $(this).attr('id', 'outlist-box');
  });
  */

  // tmp
  $( ".tabs" ).tabs();
  $( "#sortable" ).sortable();
  $( "#sortable" ).disableSelection();

  // Admininteractions

  $('#search').on('keyup',function(){
      $search = $(this).val();
      $type = $('#type').val();
      $.ajax({
        type: 'get',
        url: '/search',
        data: {'search':$search,'type':$type},
        success:function(data)
        {
          $('#searchresult').html(data);
        }

      });
  });

});