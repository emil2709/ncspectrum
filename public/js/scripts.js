
$(document).ready(function(){

  window.userid;
  window.counter = 0;
  window.users = new Array();
  window.onload = checkinCheck();
  window.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

  $("#welcome").hide().fadeIn(3000);

  // Userinteractions

  $("#outlist, #inlist").sortable({
      revert: true,
      connectWith: ".connectedSortable",
      placeholder: "placeholder"
  }).disableSelection();

  $("#outlist").sortable({
      start: function(event, ui){
        userid = ui.item.children('#userid').html();
      },
      receive: function(){
        var index = users.indexOf(userid);
        users.splice(index,1);
        counter--;
        checkinCheck();
        console.log(users);
      }
  });

  $("#inlist").sortable({
      start: function(event, ui){
        userid = ui.item.children('#userid').html();
      },
      receive: function(){
        users[counter++] = userid;
        checkinCheck();
        console.log(users);
      }
  });

 function checkinCheck()
  {
      console.log(users.length);
      if(users.length <= 0)
      {
        $("#checkin-btn").attr('disabled', true);
      }
      else
      {
        $("#checkin-btn").attr('disabled', false);
      }
  }

  $('#checkin-btn').click(function(){
      console.log(users + " HERE ");
      $.ajax({
          /* the route pointing to the post function */
          url: '/visit',
          type: 'POST',
          /* send the csrf-token and the input to the controller */
          data: {_token: CSRF_TOKEN,message:users},
          dataType: 'JSON'
      }); 
  });

  function checkout()
  {
      $userid = userid;
      $.ajax({
          type: 'get',
          url: '/checkout',
          data: {'checkout':$userid},
          success:function(data)
          {
            //
          }

        });
  }

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