$(document).ready(function(){

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
   * Page Check
   *
   * This function is only ran on the page with URL "/", aka the index/home page in order to
   * set some startup values and do some pageload-checks.
   * 
   * SessionStorage: Session variable is set in order to store and transfer values across all fucntions.
   * CSRF-token: Set in order for the communication between fontend and backend to work properly.
   * Function "startup()": Runs on every page-load in order to check some startup values and synchronize.
   * Function "SetInterval()":" will reload the page every 15min in order to synchronize the frontend 
   * checkin/checkout statuses with the ones in the database.
   */
  if(window.location.pathname == "/")
  {
    window.sessionStorage;
    window.CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    window.onload = startup();
  
    setInterval(function() {
      location.reload(true);
    }, 900 * 1000); // 60 * 1000 milsec
  }

  /**
   * Drag and Drop Connection
   *
   * This function is used to connect the two check-in/-out lists and drag and drop elements among them.
   * Revert: The element will return to its original place if not dropped in an acceptable area.
   * ConnectedWith: Name of the class the lists are connected to. They are connected to each other.
   * Placeholder: Name of the class that adds CSS to the placehodlers.
   * Helper: Used in order to differentiate "drag and drop" and simple "click".
   * Found on: http://api.jqueryui.com/
   */
  $("#outlist, #inlist").sortable({
    revert: true,
    connectWith: ".connectedSortable",
    placeholder: "placeholder",
    helper: "clone"
  }).disableSelection();

  /**
   * Drag and Drop Checkout-list
   *
   * Sets the actions that are to be done on list-item start and receive.
   * 
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
      $(ui.item).attr('id','out');
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
      $(ui.item).attr('id','in');
    }
  }).disableSelection();
  
  $("#outlist").on('click','#out',function(event){
    sessionStorage.userid = $(this).children('#userid').html();
    $('#inlist').prepend($(this).removeClass(this));
    $(this).switchClass( "userbox", "userbox-in", 1000 );
    $(this).attr('id','in');
    checkin();
    statusin();
    checkinCheck();
  });

  $("#inlist").on('click','#in', function(event){
    sessionStorage.userid = $(this).children('#userid').html();
    $('#outlist').prepend($(this).removeClass(this));
    $(this).switchClass( "userbox-in", "userbox", 1000 );
    $(this).attr('id','out');
    checkout();
    statusout();
    checkinCheck();
  });

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
  }

 function checkinCheck()
  {
    sessionStorage.listlength= $('#inlist li').length;
    if(sessionStorage.listlength <= 0)
    {
      $("#checkin-btn").attr('disabled', true);
      listsync();
    }
    else
    {
      $("#checkin-btn").attr('disabled', false);
    }
  }

  function listsync()
  {
    newusers = new Array();
    sessionStorage.users = JSON.stringify(newusers);
    sessionStorage.counter = 0;
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