
$(document).ready(function(){

  $("#welcome").hide().fadeIn(3000);

  // Userinteractions

  $("#outlist, #inlist").sortable({
      revert: true,
      connectWith: ".connectedSortable",
      placeholder: "placeholder"
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

  $('#usersearch').on('keyup',function(){
      $usersearch = $(this).val();
      $.ajax({
        type: 'get',
        url: '/usersearch',
        data: {'usersearch':$usersearch},
        success:function(data)
        {
          $('#outlist').html(data);
        }

      });
  });

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

  $('#updateAvatarToggle').click(function(){
    $(this).hide();
  });

  $('#updateAvatarCancel').click(function(){
    $('#updateAvatarToggle').delay(500).show(0);
  });

  $('#updateAvatarSave').click(function(){
    var filename = $('#avatar').val();
    if(filename == "")
    {
      return false;
    }
  });


});