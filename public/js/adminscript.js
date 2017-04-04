window.toggled = false;

window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
  });
}, 4000);

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
  $('#updateAvatarToggle').delay(600).show(0);
});

$('#updateAvatarSave').click(function(){
  var filename = $('#avatar').val();
  if(filename == "")
  {
    return false;
  }
});

$(".guest-expansion").hide();

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

function sortTable(n) 
{
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("sortableTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while(switching) 
  {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for(i = 1; i < (rows.length - 1); i++) 
    {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if(dir == "asc") 
      {
        if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) 
        {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } 
      else if(dir == "desc") 
      {
        if(x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) 
        {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if(shouldSwitch) 
    {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } 
    else 
    {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if(switchcount == 0 && dir == "asc") 
      {
        dir = "desc";
        switching = true;
      }
    }
  }
}

var step = 4, // colorChage step, use negative value to change direction
    ms   = 20,  // loop every
    $uni = $('.unicorn'),
    txt  = $uni.text(),
    len  = txt.length,
    lev  = 360/len,
    newCont = "",
    itv;

for(var i=0; i<len; i++)newCont += "<span style='color:hsla("+ i*lev +", 100%, 50%, 1)'>"+ txt.charAt(i) +"</span>";

$uni.html(newCont); // Replace with new content
var $ch = $uni.find('span'); // character

function stop(){ clearInterval(itv); }
function anim(){
  itv = setInterval(function(){
    $ch.each(function(){
      var h = +$(this).attr('style').split(',')[0].split('(')[1]-step % 360;
      $(this).attr({style:"color:hsla("+ h +", 100%, 50%, 1)"});
    });
  }, ms); 
}

$uni.hover(anim,stop);
