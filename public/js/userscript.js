
$(document).ready(function(){

  window.sessionStorage;
  window.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  window.onload = startup();

  if(window.location.pathname == "/index")
  {
    setInterval(function() {
      location.reload();
    }, 900 * 1000); // 60 * 1000 milsec
  }

  window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
      });
  }, 4000);

  /** Temp functions **/

  $("#welcome").hide().fadeIn(3000);
  $( ".tabs" ).tabs();
  $( "#sortable" ).sortable();
  $( "#sortable" ).disableSelection();

  /** Userinteractions **/

  $("#outlist, #inlist").sortable({
    revert: true,
    connectWith: ".connectedSortable",
    placeholder: "placeholder",
    helper: "clone"
  }).disableSelection();
  
  /*
  $("#outlist #out").on('click',function(event){
    console.log('clicked');
    //$('#inlist').append($(this).removeClass(this));
    //$(this).switchClass( "userbox", "userbox-in", 1000 );
    var id = $('#outlist #userid[id]:first').html();
    console.log(id);
    console.log(event.target);
  });

  $("#in").click(function(event, ui){
    $('.userbox-in').append($(this).removeClass(this));
    $(ui.item).switchClass( "userbox", "userbox-in", 1000 );
    document.getElementById('one').id = 'two'
    $(this).attr('class', 'userbox');
  });
  */

  $("#outlist").sortable({
    start: function(event, ui){
      sessionStorage.userid = ui.item.children('#userid').html();
    },
    receive: function(event, ui){
      checkout();
      statusout();
      checkinCheck();
      $(ui.item).switchClass( "userbox-in", "userbox", 1000 );
    },
  }).disableSelection();

  $("#inlist").sortable({
    start: function(event, ui){
      sessionStorage.userid = ui.item.children('#userid').html();
    },
    receive: function(event, ui){
      checkin();
      statusin();
      checkinCheck();
      $(ui.item).switchClass( "userbox", "userbox-in", 1000 );
    }
  }).disableSelection();

  function startup()
  {
    if(!sessionStorage.listlength)
    {
        sessionStorage.listlength = 0;
    }
    if(!sessionStorage.counter)
    {
        sessionStorage.counter = 0;
    }
    if(!sessionStorage.users)
    {
        var users = new Array();
        sessionStorage.users = JSON.stringify(users);
    }
    checkinCheck();
    listsync();
  }

 function checkinCheck()
  {
    sessionStorage.listlength= $('#inlist li').length;
    if(sessionStorage.listlength <= 0)
    {
      $("#checkin-btn").attr('disabled', true);
    }
    else
    {
      $("#checkin-btn").attr('disabled', false);
    }
  }

  function listsync()
  {
    if($('#inlist').length)
    {
      if(sessionStorage.listlength < 1)
      {
        newusers = new Array();
        sessionStorage.users = JSON.stringify(newusers);
        sessionStorage.counter = 0;
      }
    }
  }

  function checkin()
  {
    var users = JSON.parse(sessionStorage.users);
    var counter = Number(sessionStorage.counter);

    users[counter++] = sessionStorage.userid;
    sessionStorage.counter = counter;
    sessionStorage.users = JSON.stringify(users);
  }

  function checkout()
  {
    var users = JSON.parse(sessionStorage.users);
    var index = users.indexOf(sessionStorage.userid);
    var counter = Number(sessionStorage.counter);

    users.splice(index,1);
    counter--;
    if(counter < 0)
    {
      counter = 0;
    }
    sessionStorage.counter = counter;
    sessionStorage.users = JSON.stringify(users);
  }

    $("#checkin-btn").click(function(){
      var users = JSON.parse(sessionStorage.users);
      $.ajax({
        url: '/userlist',
        type: 'post',
        data: {_token: CSRF_TOKEN, data: users},
        dataType: 'JSON',
        success: function(){
          location.href = "/visit";
        }
      }); 
    });

  function statusin()
  {
    var userid = sessionStorage.userid;
    $.ajax({
      url: '/statusin',
      type: 'post',
      data: {_token: CSRF_TOKEN, data: userid},
      dataType: 'JSON'
    });
  }

  function statusout()
  {
    var userid = sessionStorage.userid;
    $.ajax({
        url: '/statusout',
        type: 'post',
        data: {_token: CSRF_TOKEN, data: userid},
        dataType: 'JSON'
    });
  }

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

});