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
   * Function "SetInterval()": will reload the page every 15min in order to synchronize the frontend 
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
   * Start: Stores the ID of the user thats being dragged in a session variable.
   * Receive: Does the following functions on receiving a user from the other list.
   * Also changes the CSS class and ID from "in" to "out".
   * Found on: http://api.jqueryui.com/
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


  /**
   * Drag and Drop Checkin-list
   *
   * Sets the actions that are to be done on list-item start and receive.
   * Start: Stores the ID of the user thats being dragged in a session variable.
   * Receive: Does the following functions on receiving a user from the other list.
   * Also changes the CSS class and ID from "out" to "in".
   * Found on: http://api.jqueryui.com/
   */
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
  
  /**
   * Click on Checkout-list
   *
   * Sets the actions that are to be done when clicking on a user in the checkout-list.
   * Saves the clicked on user´s ID in a session variable.
   * Removes the clicked on user from the outlist and moves it to the inlist along with CSS and ID change.
   * Does the following functions to synchronize various variables and states.
   */
  $("#outlist").on('click','#out',function(event){
    sessionStorage.userid = $(this).children('#userid').html();
    $('#inlist').prepend($(this).removeClass(this));
    $(this).switchClass( "userbox", "userbox-in", 1000 );
    $(this).attr('id','in');
    checkin();
    statusin();
    checkinCheck();
  });

  /**
   * Click on Checkin-list
   *
   * Sets the actions that are to be done when clicking on a user in the checkin-list.
   * Saves the clicked on user´s ID in a session variable.
   * Removes the clicked on user from the inlist and moves it to the outlist along with CSS and ID change.
   * Does the following functions to synchronize various variables and states.
   */
  $("#inlist").on('click','#in', function(event){
    sessionStorage.userid = $(this).children('#userid').html();
    $('#outlist').prepend($(this).removeClass(this));
    $(this).switchClass( "userbox-in", "userbox", 1000 );
    $(this).attr('id','out');
    checkout();
    statusout();
    checkinCheck();
  });

  /**
   * Startup
   *
   * This function runs on every pageload and checks if the pageload is a completely new or refresh.
   * Sets the various session variables and arrays if the pageload is not a refresh.
   * Then does a followup checkinCheck().
   */
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

  /**
   * Checkin Button Check
   *
   * This function enables and disables the checkin button.
   * Whenever this function is called it will check the length of the inlist
   * in order to see how many are checked in. 
   * If the inlist is empty it will disable the checkin button, 
   * If the inlist is not empty, it will enable the checkin button.
   * In the end, if the inlist is empty or the inlist length and the length of the users array is different
   * listsync() will be called.
   */
  function checkinCheck()
  {
    sessionStorage.listlength = $('#inlist li').length;
    var listlength = sessionStorage.listlength;
    var users = JSON.parse(sessionStorage.users);

    if(listlength <= 0)
    {
      $("#checkin-btn").attr('disabled', true);
    }
    else
    {
      $("#checkin-btn").attr('disabled', false);
    }
    if((listlength <= 0) || (listlength != users.length))
    {
      listsync();
    }
  }

  /**
   * List Synchronize
   *
   * This function is called whenever the inlist is empty or the inlist length and users arraylength 
   * does not match. This is done in order to properly synchronize the client-sided variables and arrays.
   * This is mostly used as a backup function incase someone changes the checkin status of one or more users in the backend. 
   * The backend status change will not get registered in the frontend variables and arrays, so to keep both backend and frontend 
   * variables consistent and synchronized this function is called.
   * This function is connected to the "UserController" with method "listsync()".
   * 
   */
  function listsync()
  {
    var listlength = sessionStorage.listlength;
    var users = JSON.parse(sessionStorage.users);

    if(listlength <= 0)
    {
      newusers = new Array();
      sessionStorage.users = JSON.stringify(newusers);
      sessionStorage.counter = 0;
    }
    else
    {
      $.ajax({
        type: 'get',
        url: '/listsync',
        success:function(data)
        {
          // Upon success means the backend variables are updated, so we fetch the variables from backend and apply them to the
          // frontend variables to keep them synchronized.
          sessionStorage.users = JSON.stringify(data);
          sessionStorage.counter = data.length;
        }
      });
    }
  }

  /**
   * Frontend checkin
   *
   * This function is called whenever a user is checking in, moved from the outlist to inlist.
   * The users array will be updated with the users id, along with the counter which acts as both a counter for
   * number of users checkedin and as an index for the users array.
   */
  function checkin()
  {
    var users = JSON.parse(sessionStorage.users);
    var counter = Number(sessionStorage.counter);

    users[counter++] = sessionStorage.userid;
    sessionStorage.counter = counter;
    sessionStorage.users = JSON.stringify(users);
  }

  /**
   * Frontend checkout
   *
   * This function is called whenever a user is checking out, moved from the inlist to outlist.
   * The users array will be updated by removing the userid from the users array, along with updating
   * the counter which acts as both a counter for number of users checkedin and as an index for the users array.
   */
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

  /**
   * Backend checkin
   *
   * This function is called whenever a user is checking in, moved from the outlist to inlist.
   * This function will update the backend list of the checkedin users.
   * By using AJAX this function will send the userid to the UserController and change its status and save it
   * in the array of checkedin users.
   * This function is connected to the "UserController" with method "statusin()".
   */
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

  /**
   * Backend checkout
   *
   * This function is called whenever a user is checking out, moved from the inlist to outlist.
   * This function will update the backend list of the checkedin users.
   * By using AJAX this function will send the userid to the UserController and change its status and remove it
   * from the array of checkedin users.
   * This function is connected to the "UserController" with method "statusout()".
   */
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

  /**
   * Checkin Button
   * 
   * This function is called when the Checkin button is clicked.
   * AJAX will send all the users saved in the array to backend so it can find the 
   * saved users from the database. 
   * This will upon success direct the users to the visit creation page.
   * This function is connected to the "UserController" with method "userlist()".
   */
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


  /**
   * Livesearch 
   *
   * This is an AJAX function that allows us to do livesearch.
   * This function will listen to livesearch-inputfields and send the typed letters in real time to 
   * preform a livesearch in the connected database and return the found results.
   * This function is connected to the "UserController" with method "usersearch()".
   */
  $('#usersearch').on('keyup',function(){
    // Gets the values/letters that is typed in the livesearch-field
    $usersearch = $(this).val();
    // Sends the values to the controller to preform a livesearch
    $.ajax({
      type: 'get',
      url: '/usersearch',
      data: {'usersearch':$usersearch},
      success:function(data)
      {
        // Result will replace the contents of the written ID
        $('#outlist').html(data);
      }
    });
  });

});

$('#printer').click(function()
{
      var users = JSON.parse(sessionStorage.users);
      console.log("LIST: "+sessionStorage.listlength);
      console.log("ARRAY: "+users.length);
      console.log("COUNTER: " +sessionStorage.counter);
      console.log(sessionStorage.users);
});