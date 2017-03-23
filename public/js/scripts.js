
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
      receive: function(event, ui){
        console.log(userid);
        var index = users.indexOf(userid);
        users.splice(index,1);
        counter--;
        checkinCheck();
        checkout();
        $(ui.item).switchClass( "userbox-in", "userbox", 1000 );
      }
  });

  $("#inlist").sortable({
      start: function(event, ui){
        userid = ui.item.children('#userid').html();
      },
      receive: function(event, ui){
        console.log(userid);
        users[counter++] = userid;
        checkinCheck();
        checkin();
        $(ui.item).switchClass( "userbox", "userbox-in", 1000 );
      }
  });

 function checkinCheck()
  {
      if(users.length <= 0)
      {
        $("#checkin-btn").attr('disabled', true);
      }
      else
      {
        $("#checkin-btn").attr('disabled', false);
      }
  }

   $("#checkin-btn").click(function(){
      $.ajax({
          url: '/userlist',
          type: 'post',
          data: {_token: CSRF_TOKEN, data:users},
          dataType: 'JSON',
          success: function(){
            location.href = "/visit";
          }
      }); 
    });

  function checkin()
  {
      $.ajax({
          url: '/checkin',
          type: 'post',
          data: {_token: CSRF_TOKEN, data:userid},
          dataType: 'JSON',
          success: function(){
            console.log('checkin done');
          }
      });
  }

  function checkout()
  {
      $.ajax({
          url: '/checkout',
          type: 'post',
          data: {_token: CSRF_TOKEN, data:userid},
          dataType: 'JSON',
          success: function(){
            console.log('checkout done');
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