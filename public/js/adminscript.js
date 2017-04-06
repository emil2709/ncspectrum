window.toggled = false;

window.setTimeout(function() {
  $(".alert").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
  });
}, 4000);

$(document).ready(function(){ 
  $("#myTable").tablesorter({dateFormat: "uk"}); 
}); 

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

var step = 4, // colorChage step, use negative value to change direction
    ms   = 20,  // loop every
    $uni = $('.rainbow'),
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